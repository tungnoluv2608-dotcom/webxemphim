<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            // GÓI FREE
            [
                'type' => 'free',
                'name' => 'Gói Miễn Phí',
                'description' => 'Gói xem phim cơ bản miễn phí',
                'price' => 0,
                'duration_days' => 9999, // Vĩnh viễn
                'daily_limit' => 3, // 3 phim/ngày
                'quality_limit' => 2, // HD (720p)
                'ads_enabled' => true, // Có quảng cáo
                'download_enabled' => false, // Không tải xuống
                'features' => json_encode([
                    'Xem tối đa 3 phim mỗi ngày',
                    'Chất lượng HD (720p)',
                    'Có quảng cáo khi xem phim',
                    'Không giới hạn thời gian sử dụng',
                    'Hỗ trợ cơ bản'
                ]),
                'status' => true
            ],

            // GÓI CƠ BẢN
            [
                'type' => 'premium',
                'name' => 'Gói Cơ Bản',
                'description' => 'Gói dịch vụ cơ bản với nhiều ưu đãi',
                'price' => 49000,
                'duration_days' => 30,
                'daily_limit' => 10, // 10 phim/ngày
                'quality_limit' => 3, // Full HD
                'ads_enabled' => false, // Không quảng cáo
                'download_enabled' => false, // Không tải xuống
                'features' => json_encode([
                    'Xem tối đa 10 phim mỗi ngày',
                    'Chất lượng Full HD (1080p)',
                    'Không quảng cáo',
                    'Truy cập không giới hạn thư viện phim',
                    'Hỗ trợ 24/7',
                    'Xem trên 1 thiết bị cùng lúc'
                ]),
                'status' => true
            ],

            // GÓI CAO CẤP
            [
                'type' => 'premium',
                'name' => 'Gói Cao Cấp',
                'description' => 'Gói dịch vụ cao cấp với trải nghiệm tốt nhất',
                'price' => 99000,
                'duration_days' => 30,
                'daily_limit' => null, // Không giới hạn
                'quality_limit' => 4, // 4K
                'ads_enabled' => false, // Không quảng cáo
                'download_enabled' => true, // Cho phép tải xuống
                'features' => json_encode([
                    'Xem không giới hạn phim mỗi ngày',
                    'Chất lượng 4K (2160p)',
                    'Không quảng cáo',
                    'Tải phim xuống xem offline',
                    'Truy cập không giới hạn thư viện phim',
                    'Xem trên 2 thiết bị cùng lúc',
                    'Hỗ trợ 24/7 VIP'
                ]),
                'status' => true
            ],

            // GÓI GIA ĐÌNH
            [
                'type' => 'premium',
                'name' => 'Gói Gia Đình',
                'description' => 'Gói dịch vụ cho cả gia đình',
                'price' => 149000,
                'duration_days' => 30,
                'daily_limit' => null, // Không giới hạn
                'quality_limit' => 4, // 4K
                'ads_enabled' => false, // Không quảng cáo
                'download_enabled' => true, // Cho phép tải xuống
                'features' => json_encode([
                    'Xem không giới hạn phim mỗi ngày',
                    'Chất lượng 4K (2160p)',
                    'Không quảng cáo',
                    'Tải phim xuống xem offline',
                    'Truy cập không giới hạn thư viện phim',
                    'Xem trên 4 thiết bị cùng lúc',
                    'Hồ sơ người xem riêng biệt',
                    'Hỗ trợ 24/7 VIP',
                    'Parental Control (Kiểm soát của phụ huynh)'
                ]),
                'status' => true
            ]
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}