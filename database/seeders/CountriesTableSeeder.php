<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{

    public function run(): void
    {

        $countries = [
            ['code'=>'RM','iso'=>'MH','tld'=>'.mh','name_en'=>'Marshall Islands','name_fa'=>'جزایر مارشال'],
            ['code'=>'RN','iso'=>'MF','tld'=>'-','name_en'=>'Saint Martin','name_fa'=>'سنت مارتین'],
            ['code'=>'RO','iso'=>'RO','tld'=>'.ro','name_en'=>'Romania','name_fa'=>'رومانی'],
            ['code'=>'RP','iso'=>'PH','tld'=>'.ph','name_en'=>'Philippines','name_fa'=>'فیلیپین'],
            ['code'=>'RQ','iso'=>'PR','tld'=>'.pr','name_en'=>'Puerto Rico','name_fa'=>'پورتوریکو'],
            ['code'=>'RS','iso'=>'RU','tld'=>'.ru','name_en'=>'Russia','name_fa'=>'روسیه'],
            ['code'=>'RW','iso'=>'RW','tld'=>'.rw','name_en'=>'Rwanda','name_fa'=>'رواندا'],
            ['code'=>'SA','iso'=>'SA','tld'=>'.sa','name_en'=>'Saudi Arabia','name_fa'=>'عربستان سعودی'],
            ['code'=>'SB','iso'=>'PM','tld'=>'.pm','name_en'=>'Saint Pierre and Miquelon','name_fa'=>'سنت پیر و میکلون'],
            ['code'=>'SC','iso'=>'KN','tld'=>'.kn','name_en'=>'Saint Kitts and Nevis','name_fa'=>'سنت کیتس و نویس'],
            ['code'=>'SE','iso'=>'SC','tld'=>'.sc','name_en'=>'Seychelles','name_fa'=>'سیشل'],
            ['code'=>'SF','iso'=>'ZA','tld'=>'.za','name_en'=>'South Africa','name_fa'=>'آفریقای جنوبی'],
            ['code'=>'SG','iso'=>'SN','tld'=>'.sn','name_en'=>'Senegal','name_fa'=>'سنگال'],
            ['code'=>'SH','iso'=>'SH','tld'=>'.sh','name_en'=>'Saint Helena','name_fa'=>'سنت هلن'],
            ['code'=>'SI','iso'=>'SI','tld'=>'.si','name_en'=>'Slovenia','name_fa'=>'اسلوونی'],
            ['code'=>'SL','iso'=>'SL','tld'=>'.sl','name_en'=>'Sierra Leone','name_fa'=>'سیرا لئون'],
            ['code'=>'SM','iso'=>'SM','tld'=>'.sm','name_en'=>'San Marino','name_fa'=>'سان مارینو'],
            ['code'=>'SN','iso'=>'SG','tld'=>'.sg','name_en'=>'Singapore','name_fa'=>'سنگاپور'],
            ['code'=>'SO','iso'=>'SO','tld'=>'.so','name_en'=>'Somalia','name_fa'=>'سومالی'],
            ['code'=>'SP','iso'=>'ES','tld'=>'.es','name_en'=>'Spain','name_fa'=>'اسپانیا'],
            ['code'=>'ST','iso'=>'LC','tld'=>'.lc','name_en'=>'Saint Lucia','name_fa'=>'سنت لوسیا'],
            ['code'=>'SU','iso'=>'SD','tld'=>'.sd','name_en'=>'Sudan','name_fa'=>'سودان'],
            ['code'=>'SV','iso'=>'SJ','tld'=>'.sj','name_en'=>'Svalbard','name_fa'=>'اسباب بازی'],
            ['code'=>'SW','iso'=>'SE','tld'=>'.se','name_en'=>'Sweden','name_fa'=>'سوئد'],
            ['code'=>'SX','iso'=>'GS','tld'=>'.gs','name_en'=>'South Georgia and the Islands','name_fa'=>'جنوب گرجستان و جزایر'],
            ['code'=>'SY','iso'=>'SY','tld'=>'.sy','name_en'=>'Syrian Arab Republic','name_fa'=>'جمهوری عربی سوریه'],
            ['code'=>'SZ','iso'=>'CH','tld'=>'.ch','name_en'=>'Switzerland','name_fa'=>'سوئیس'],
            ['code'=>'TD','iso'=>'TT','tld'=>'.tt','name_en'=>'Trinidad and Tobago','name_fa'=>'ترینیداد و توباگو'],
            ['code'=>'TE','iso'=>'-','tld'=>'-','name_en'=>'Tromelin Island','name_fa'=>'جزیره ترولین'],
            ['code'=>'TH','iso'=>'TH','tld'=>'.th','name_en'=>'Thailand','name_fa'=>'تایلند'],
            ['code'=>'TI','iso'=>'TJ','tld'=>'.tj','name_en'=>'Tajikistan','name_fa'=>'تاجیکستان'],
            ['code'=>'TK','iso'=>'TC','tld'=>'.tc','name_en'=>'Turks and Caicos Islands','name_fa'=>'جزایر ترکس و کایکوس'],
            ['code'=>'TL','iso'=>'TK','tld'=>'.tk','name_en'=>'Tokelau','name_fa'=>'توکلو'],
            ['code'=>'TN','iso'=>'TO','tld'=>'.to','name_en'=>'Tonga','name_fa'=>'تونگا'],
            ['code'=>'TO','iso'=>'TG','tld'=>'.tg','name_en'=>'Togo','name_fa'=>'رفتن'],
            ['code'=>'TP','iso'=>'ST','tld'=>'.st','name_en'=>'Sao Tome and Principe','name_fa'=>'سائوتومه و پرنسیپه'],
            ['code'=>'TS','iso'=>'TN','tld'=>'.tn','name_en'=>'Tunisia','name_fa'=>'تونس'],
            ['code'=>'TT','iso'=>'TL','tld'=>'.tl','name_en'=>'East Timor','name_fa'=>'تیمور شرقی'],
            ['code'=>'TU','iso'=>'TR','tld'=>'.tr','name_en'=>'Turkey','name_fa'=>'ترکیه'],
            ['code'=>'TV','iso'=>'TV','tld'=>'.tv','name_en'=>'Tuvalu','name_fa'=>'توووالو'],
            ['code'=>'TW','iso'=>'TW','tld'=>'.tw','name_en'=>'Taiwan','name_fa'=>'تایوان'],
            ['code'=>'TX','iso'=>'TM','tld'=>'.tm','name_en'=>'Turkmenistan','name_fa'=>'ترکمنستان'],
            ['code'=>'TZ','iso'=>'TZ','tld'=>'.tz','name_en'=>'Tanzania, United Republic of','name_fa'=>'تانزانیا، جمهوری متحده'],
            ['code'=>'UG','iso'=>'UG','tld'=>'.ug','name_en'=>'Uganda','name_fa'=>'اوگاندا'],
            ['code'=>'UK','iso'=>'GB','tld'=>'.uk','name_en'=>'United Kingdom','name_fa'=>'انگلستان'],
            ['code'=>'UP','iso'=>'UA','tld'=>'.ua','name_en'=>'Ukraine','name_fa'=>'اوکراین'],
            ['code'=>'US','iso'=>'US','tld'=>'.us','name_en'=>'United States','name_fa'=>'ایالات متحده'],
            ['code'=>'UV','iso'=>'BF','tld'=>'.bf','name_en'=>'Burkina Faso','name_fa'=>'بورکینافاسو'],
            ['code'=>'UY','iso'=>'UY','tld'=>'.uy','name_en'=>'Uruguay','name_fa'=>'اروگوئه'],
            ['code'=>'UZ','iso'=>'UZ','tld'=>'.uz','name_en'=>'Uzbekistan','name_fa'=>'ازبکستان'],
            ['code'=>'VC','iso'=>'VC','tld'=>'.vc','name_en'=>'Saint Vincent and the Grenadines','name_fa'=>'سنت وینسنت و گرنادین'],
            ['code'=>'VE','iso'=>'VE','tld'=>'.ve','name_en'=>'Venezuela','name_fa'=>'ونزوئلا'],
            ['code'=>'VI','iso'=>'VG','tld'=>'.vg','name_en'=>'British Virgin Islands','name_fa'=>'جزایر ویرجین بریتانیا'],
            ['code'=>'VM','iso'=>'VN','tld'=>'.vn','name_en'=>'Vietnam','name_fa'=>'ویتنام'],
            ['code'=>'VQ','iso'=>'VI','tld'=>'.vi','name_en'=>'Virgin Islands (US)','name_fa'=>'جزایر ویرجین (ایالات متحده)'],
            ['code'=>'VT','iso'=>'VA','tld'=>'.va','name_en'=>'Holy See (Vatican City)','name_fa'=>'مقدس (واتیکان)'],
            ['code'=>'WA','iso'=>'NA','tld'=>'.na','name_en'=>'Namibia','name_fa'=>'نامیبیا'],
            ['code'=>'WE','iso'=>'-','tld'=>'-','name_en'=>'West Bank','name_fa'=>'بانک غرب'],
            ['code'=>'WF','iso'=>'WF','tld'=>'.wf','name_en'=>'Wallis and Futuna','name_fa'=>'والیس و فوتونا'],
            ['code'=>'WI','iso'=>'EH','tld'=>'.eh','name_en'=>'Western Sahara','name_fa'=>'صحرای غربی'],
            ['code'=>'WQ','iso'=>'UM','tld'=>'-','name_en'=>'Wake Island','name_fa'=>'جزیره ویک'],
            ['code'=>'WS','iso'=>'WS','tld'=>'.ws','name_en'=>'Samoa','name_fa'=>'ساموآ'],
            ['code'=>'WZ','iso'=>'SZ','tld'=>'.sz','name_en'=>'Swaziland','name_fa'=>'سوازیلند'],
            ['code'=>'YI','iso'=>'CS','tld'=>'.yu','name_en'=>'Serbia and Montenegro','name_fa'=>'صربستان و مونته نگرو'],
            ['code'=>'YM','iso'=>'YE','tld'=>'.ye','name_en'=>'Yemen','name_fa'=>'یمن'],
            ['code'=>'ZA','iso'=>'ZM','tld'=>'.zm','name_en'=>'Zambia','name_fa'=>'زامبیا'],
            ['code'=>'ZI','iso'=>'ZW','tld'=>'.zw','name_en'=>'Zimbabwe','name_fa'=>'زیمبابوه'],
        ];


        $countries = array_map(fn($row) => array_merge($row, [
            'created_at' => now(),
            'updated_at' => now(),
        ]), $countries);
        Country::query()->insertOrIgnore($countries);
    }
}
