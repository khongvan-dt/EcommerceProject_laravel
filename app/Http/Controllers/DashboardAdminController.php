<?php
namespace App\Http\Controllers;
use App\Models\AttributeValues;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardAdminController extends Controller implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

     public function collection()
    {
        return $this->getSalesReportData($this->startDate, $this->endDate);
    }

     public function headings(): array
    {
        return [
            'Tên Sản Phẩm',
            'Giá Nhập',
            'Giá Bán',
            'Số Lượng Bán',
            'Số Lượng Khách',
            'Tổng Doanh Thu',
            'Tổng Vốn',
            'Tổng Lãi',
            'Tỷ Lệ Lãi (%)'
        ];
    }

    public function map($row): array
    {
        return [
            $row->name,
            number_format($row->priceIn * 1000, 0, ',', '.') . ' đ',  // Nhân giá nhập với 1000
            number_format($row->price * 1000, 0, ',', '.') . ' đ',     // Nhân giá bán với 1000
            $row->total_quantity,
            $row->total_customers,
            number_format($row->total_revenue * 1000, 0, ',', '.') . ' đ',  // Nhân tổng doanh thu với 1000
            number_format($row->total_cost * 1000, 0, ',', '.') . ' đ',     // Nhân tổng vốn với 1000
            number_format($row->total_profit * 1000, 0, ',', '.') . ' đ',   // Nhân tổng lãi với 1000
            $row->profit_percentage . '%'  // Tỷ lệ phần trăm giữ nguyên
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],  
            'A:I' => ['alignment' => ['center']],
        ];
    }
    public function index(Request $request) {
        
        // Lấy số tiền nhập hàng trong tháng này và tháng trước
        $totalPriceInThisMonth = $this->getTotalPriceInMonth(now()->month, now()->year);
        $totalPriceInLastMonth = $this->getTotalPriceInMonth(now()->subMonth()->month, now()->subMonth()->year);

        // Tính toán sự thay đổi phần trăm
        $percentageChangePriceIn = $this->calculatePercentageChange($totalPriceInThisMonth, $totalPriceInLastMonth);

        // Doanh thu bán hàng
        $totalSalesRevenueThisMonth = $this->getTotalSalesRevenue(now()->month, now()->year);
        $totalSalesRevenueLastMonth = $this->getTotalSalesRevenue(now()->subMonth()->month, now()->subMonth()->year);
        $percentageChangePriceOut = $this->calculatePercentageChange($totalSalesRevenueThisMonth, $totalSalesRevenueLastMonth);

        // Đơn hàng trong 30 ngày qua
        $totalOrdersLast30Days = $this->getTotalOrders(30);
        $totalOrdersPrevious30Days = $this->getTotalOrders(60, 30);
        $percentageOrders = $this->calculatePercentageChange($totalOrdersLast30Days, $totalOrdersPrevious30Days);

        // Người dùng mới trong 30 ngày qua
        $totalUsersLast30Days = $this->getTotalUsers(30);
        $totalUsersPrevious30Days = $this->getTotalUsers(60, 30);
        $percentageUsers = $this->calculatePercentageChange($totalUsersLast30Days, $totalUsersPrevious30Days);
        $getBestSelling30Days = $this->getBestSelling30Days();
        $getBestSelling7Days = $this->getBestSelling7Days();
        $getBestSellingThisYear= $this->getBestSellingThisYear();

        $timeframe = $request->input('timeframe', 'monthly');
        $chartData = $this->getSalesData($timeframe);

        if ($request->has('export')) {
            $this->startDate = $request->input('startDate');
            $this->endDate = $request->input('endDate');
            $fileName = 'bao-cao-doanh-thu-' . date('d-m-Y') . '.xlsx';
            
            return Excel::download($this, $fileName)
                ->deleteFileAfterSend(true);
        }
        return view('admin.dashboard', [
            'totalSalesRevenueThisMonth' => $totalSalesRevenueThisMonth,
            'totalPriceInThisMonth' => $totalPriceInThisMonth,
            'totalPriceInLastMonth' => $totalPriceInLastMonth,
            'percentageChangePriceIn' => $percentageChangePriceIn,
            'totalSalesRevenueLastMonth' => $totalSalesRevenueLastMonth,
            'percentageChangePriceOut' => $percentageChangePriceOut,
            'totalOrdersLast30Days' => $totalOrdersLast30Days,
            'percentageOrders' => $percentageOrders,
            'totalUsersLast30Days' => $totalUsersLast30Days,
            'percentageUsers' => $percentageUsers,
            'chartData' => $chartData,
            'timeframe' => $timeframe, 
            'getBestSelling30Days' => $getBestSelling30Days,
            'getBestSellingThisYear'=> $getBestSellingThisYear,
            'getBestSelling7Days' => $getBestSelling7Days
        ]);
    }
    
    public function getBestSelling30Days()
    {
        return DB::table('products as p')
            ->select([
                'p.id',
                'p.name as product_name',
                'c.name as category_name',
                'av.priceOut',
                'pm.mediaUrl',
                DB::raw('SUM(od.quantity) as total_sold')
            ])
            ->join('order_details as od', 'p.id', '=', 'od.productId')
            ->join('orders as o', 'od.orderId', '=', 'o.id')
            ->join('product_category as pc', 'p.id', '=', 'pc.productId')
            ->join('categories as c', 'pc.categoryId', '=', 'c.id')
            ->join('product_attribute as pa', 'p.id', '=', 'pa.productId')
            ->join('attribute_values as av', 'pa.attributeId', '=', 'av.attributeId')
            ->join('product_media as pm', 'p.id', '=', 'pm.productId')
            ->where('o.status', '=', 'COMPLETED')
            ->where('pm.mainImage', '=', 1)
            ->where('o.created_at', '>=', DB::raw('DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)'))
            ->where('o.created_at', '<=', DB::raw('CURRENT_DATE()'))
            ->groupBy('p.id', 'p.name', 'c.name', 'av.priceOut', 'pm.mediaUrl')
            ->orderBy('total_sold', 'desc')
            ->first();
    }
    
    public function getBestSelling7Days()
    {
        return DB::table('products as p')
            ->select([
                'p.id',
                'p.name as product_name',
                'c.name as category_name',
                'av.priceOut',
                'pm.mediaUrl',
                DB::raw('SUM(od.quantity) as total_sold')
            ])
            ->join('order_details as od', 'p.id', '=', 'od.productId')
            ->join('orders as o', 'od.orderId', '=', 'o.id')
            ->join('product_category as pc', 'p.id', '=', 'pc.productId')
            ->join('categories as c', 'pc.categoryId', '=', 'c.id')
            ->join('product_attribute as pa', 'p.id', '=', 'pa.productId')
            ->join('attribute_values as av', 'pa.attributeId', '=', 'av.attributeId')
            ->join('product_media as pm', 'p.id', '=', 'pm.productId')
            ->where('o.status', '=', 'COMPLETED')
            ->where('pm.mainImage', '=', 1)
            ->where('o.created_at', '>=', DB::raw('DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)'))
            ->where('o.created_at', '<=', DB::raw('CURRENT_DATE()'))
            ->groupBy('p.id', 'p.name', 'c.name', 'av.priceOut', 'pm.mediaUrl')
            ->orderBy('total_sold', 'desc')
            ->first();
    }
    
    public function getBestSellingThisYear()
    {
        return DB::table('products as p')
            ->select([
                'p.id',
                'p.name as product_name',
                'c.name as category_name',
                'av.priceOut',
                'pm.mediaUrl',
                DB::raw('SUM(od.quantity) as total_sold')
            ])
            ->join('order_details as od', 'p.id', '=', 'od.productId')
            ->join('orders as o', 'od.orderId', '=', 'o.id')
            ->join('product_category as pc', 'p.id', '=', 'pc.productId')
            ->join('categories as c', 'pc.categoryId', '=', 'c.id')
            ->join('product_attribute as pa', 'p.id', '=', 'pa.productId')
            ->join('attribute_values as av', 'pa.attributeId', '=', 'av.attributeId')
            ->join('product_media as pm', 'p.id', '=', 'pm.productId')
            ->where('o.status', '=', 'COMPLETED')
            ->where('pm.mainImage', '=', 1)
            ->whereYear('o.created_at', '=', DB::raw('YEAR(CURRENT_DATE())'))
            ->groupBy('p.id', 'p.name', 'c.name', 'av.priceOut', 'pm.mediaUrl')
            ->orderBy('total_sold', 'desc')
            ->first();
    }

    private function getTotalPriceInMonth($month, $year) {
        return AttributeValues::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum(DB::raw('stock * priceIn'));
    }

    private function getTotalSalesRevenue($month, $year) {
        return OrderDetails::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum(DB::raw('price * quantity'));
    }

    private function getTotalOrders($days, $offsetDays = 0) {
        $startDate = now()->subDays($days + $offsetDays);
        $endDate = now()->subDays($offsetDays);
        return Orders::whereBetween('created_at', [$startDate, $endDate])->count();
    }

    private function getTotalUsers($days, $offsetDays = 0) {
        $startDate = now()->subDays($days + $offsetDays);
        $endDate = now()->subDays($offsetDays);
        return User::whereBetween('created_at', [$startDate, $endDate])->count();
    }

    private function calculatePercentageChange($currentValue, $previousValue) {
        return $previousValue > 0 ? (($currentValue - $previousValue) / $previousValue) * 100 : 0;
    }

    public function getSalesData($timeframe = 'weekly') {
        switch ($timeframe) {
            case 'weekly':
                $data = $this->getWeeklySalesData();
                if (isset($data[0])) {
                    $labels = [
                        'Tuần 4 trước',
                        'Tuần 3 trước',
                        'Tuần 2 trước',
                        'Tuần trước'
                    ];
                    $sales = [
                        floatval($data[0]->wkend4),
                        floatval($data[0]->wkend3),
                        floatval($data[0]->wkend2),
                        floatval($data[0]->wkend1)
                    ];
                } else {
                    $labels = ['Tuần 4 trước', 'Tuần 3 trước', 'Tuần 2 trước', 'Tuần trước'];
                    $sales = [0, 0, 0, 0];
                }
                break;

            case 'monthly':
                $data = $this->getMonthlySalesData();
                if (isset($data[0])) {
                    $labels = [
                        'Tháng 12', 'Tháng 11', 'Tháng 10', 'Tháng 9',
                        'Tháng 8', 'Tháng 7', 'Tháng 6', 'Tháng 5',
                        'Tháng 4', 'Tháng 3', 'Tháng 2', 'Tháng 1'
                    ];
                    $sales = [
                        floatval($data[0]->Monthly12),
                        floatval($data[0]->Monthly11),
                        floatval($data[0]->Monthly10),
                        floatval($data[0]->Monthly9),
                        floatval($data[0]->Monthly8),
                        floatval($data[0]->Monthly7),
                        floatval($data[0]->Monthly6),
                        floatval($data[0]->Monthly5),
                        floatval($data[0]->Monthly4),
                        floatval($data[0]->Monthly3),
                        floatval($data[0]->Monthly2),
                        floatval($data[0]->Monthly1)
                    ];
                } else {
                    $labels = array_map(function($i) {
                        return "Tháng $i";
                    }, range(12, 1));
                    $sales = array_fill(0, 12, 0);
                }
                break;

            default: // yearly
                $data = $this->getYearlySalesData()->toArray();
                $currentYear = now()->year;
                $yearRange = range($currentYear - 4, $currentYear);

                $labels = [];
                $sales = array_fill(0, 5, 0);

                foreach ($yearRange as $index => $year) {
                    $labels[] = "Năm $year";
                    foreach ($data as $record) {
                        if (isset($record['year']) && $record['year'] == $year) {
                            $sales[$index] = floatval($record['total_value']);
                            break;
                        }
                    }
                }
        }

        return [
            'labels' => $labels,
            'sales' => $sales
        ];
    }

    private function getMonthlySalesData() {
        return DB::table('order_details')
            ->select(
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) THEN price * quantity END), 0) AS Monthly1'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 2 MONTH) THEN price * quantity END), 0) AS Monthly2'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 3 MONTH) THEN price * quantity END), 0) AS Monthly3'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) THEN price * quantity END), 0) AS Monthly4'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 5 MONTH) THEN price * quantity END), 0) AS Monthly5'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 6 MONTH) THEN price * quantity END), 0) AS Monthly6'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 7 MONTH) THEN price * quantity END), 0) AS Monthly7'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 8 MONTH) THEN price * quantity END), 0) AS Monthly8'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 9 MONTH) THEN price * quantity END), 0) AS Monthly9'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 10 MONTH) THEN price * quantity END), 0) AS Monthly10'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 11 MONTH) THEN price * quantity END), 0) AS Monthly11'),
                DB::raw('IFNULL(SUM(CASE WHEN MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 12 MONTH) THEN price * quantity END), 0) AS Monthly12')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->get();
    }

    private function getYearlySalesData() {
        $currentYear = now()->year;
        return DB::table('order_details')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COALESCE(SUM(price * quantity), 0) as total_value')
            )
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->year => $item->total_value];
            })
            ->union(array_fill_keys(
                range($currentYear - 4, $currentYear),
                0.00
            ))
            ->sortKeys();
    }

    private function getWeeklySalesData() {
        return DB::table('order_details')
            ->select(
                DB::raw('IFNULL(SUM(CASE WHEN WEEK(created_at) = WEEK(NOW()) - 4 THEN price * quantity ELSE 0 END), 0) AS wkend4'),
                DB::raw('IFNULL(SUM(CASE WHEN WEEK(created_at) = WEEK(NOW()) - 3 THEN price * quantity ELSE 0 END), 0) AS wkend3'),
                DB::raw('IFNULL(SUM(CASE WHEN WEEK(created_at) = WEEK(NOW()) - 2 THEN price * quantity ELSE 0 END), 0) AS wkend2'),
                DB::raw('IFNULL(SUM(CASE WHEN WEEK(created_at) = WEEK(NOW()) - 1 THEN price * quantity ELSE 0 END), 0) AS wkend1')
            )
            ->whereBetween('created_at', [now()->subWeeks(4), now()])
            ->get();
    }

    public function getSalesReportData($startDate = null, $endDate = null) {
        $query = DB::table('products as p')
            ->select(
                'p.id',
                'p.name',
                'av.priceIn',
                'od.price',
                DB::raw('SUM(od.quantity) as total_quantity'),
                DB::raw('COUNT(DISTINCT o.userId) as total_customers'),
                DB::raw('SUM(od.quantity * od.price) as total_revenue'),
                DB::raw('SUM(od.quantity * av.priceIn) as total_cost'),
                DB::raw('SUM(od.quantity * (od.price - av.priceIn)) as total_profit'),
                DB::raw('ROUND((SUM(od.quantity * (od.price - av.priceIn)) / SUM(od.quantity * av.priceIn) * 100), 2) as profit_percentage')
            )
            ->join('product_attribute as pa', 'p.id', '=', 'pa.productId')
            ->join('attribute_values as av', 'pa.attributeId', '=', 'av.attributeId')
            ->join('order_details as od', 'p.id', '=', 'od.productId')
            ->join('orders as o', 'od.orderId', '=', 'o.id')
            ->where('o.status', '=', 'COMPLETED');
    
        // Thêm điều kiện lọc theo ngày tháng nếu có
        if ($startDate && $endDate) {
            $query->whereBetween('o.created_at', [$startDate, $endDate]);
        }
    
        return $query->groupBy('p.id', 'p.name', 'av.priceIn', 'od.price')
            ->orderBy('total_profit', 'desc')
            ->get();
    }
}