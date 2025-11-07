class GridDatatable {
  init() {
    this.GridjsTableInit();
  }
  GridjsTableInit() {
    document.getElementById("table-gridjs") &&
      new gridjs.Grid({
        columns: [
          {
            name: "شناسه",
            formatter: function (e) {
              return gridjs.html('<span class="fw-semibold">' + e + "</span>");
            },
          },
          "نام",
          {
            name: "ایمیل",
            formatter: function (e) {
              return gridjs.html('<a href="">' + e + "</a>");
            },
          },
          "سمت",
          "شرکت",
          "کشور",
          {
            name: "جزئیات",
            width: "120px",
            formatter: function (e) {
              return gridjs.html(
                "<a href='#' class='text-reset text-decoration-underline'>جزئیات</a>"
              );
            },
          },
        ],
        pagination: { limit: 5 },
        sort: !0,
        search: !0,
        data: [
          [
            "11",
            "علی",
            "ali@example.com",
            "مهندس نرم‌افزار",
            "شرکت ABC",
            "ایالات متحده",
          ],
          [
            "12",
            "باربد",
            "barbod@example.com",
            "مدیر محصول",
            "شرکت XYZ",
            "کانادا",
          ],
          [
            "13",
            "بهنام",
            "behnam@example.com",
            "تحلیل‌گر داده",
            "شرکت 123",
            "استرالیا",
          ],
          [
            "14",
            "داوود",
            "davood@example.com",
            "طراح UI/UX",
            "شرکت 456",
            "انگلستان",
          ],
          [
            "15",
            "افشین",
            "afshin@example.com",
            "متخصص بازاریابی",
            "شرکت 789",
            "فرانسه",
          ],
          [
            "16",
            "فرزاد",
            "farzad@example.com",
            "مدیر منابع انسانی",
            "شرکت ABC",
            "آلمان",
          ],
          [
            "17",
            "غزل",
            "ghazal@example.com",
            "تحلیل‌گر مالی",
            "شرکت XYZ",
            "ژاپن",
          ],
          [
            "18",
            "هادی",
            "hadi@example.com",
            "نماینده فروش",
            "شرکت 123",
            "برزیل",
          ],
          [
            "19",
            "سینا",
            "sina@example.com",
            "برنامه‌نویس",
            "شرکت 456",
            "هند",
          ],
          [
            "20",
            "جاوید",
            "javad@example.com",
            "مدیر عملیات",
            "شرکت 789",
            "چین",
          ],
        ],
      }).render(document.getElementById("table-gridjs")),
      document.getElementById("table-pagination") &&
        new gridjs.Grid({
          columns: [
            {
              name: "شناسه",
              width: "120px",
              formatter: function (e) {
                return gridjs.html(
                  '<a href="" class="fw-medium">' + e + "</a>"
                );
              },
            },
            "نام",
            "تاریخ",
            "مجموع",
            {
              name: "جزئیات",
              width: "100px",
              formatter: function (e) {
                return gridjs.html(
                  "<button type='button' class='btn btn-sm btn-light'>جزئیات</button>"
                );
              },
            },
          ],
          pagination: { limit: 5 },
          data: [
            ["#RB2320", "علی", "15 مهر, 1403", "$24.05"],
            ["#RB8652", "باربد", "15 مهر, 1403", "$26.15"],
            ["#RB8520", "بهنام", "14 مهر, 1403", "$21.25"],
            ["#RB9512", "داوود", "13 مهر, 1403", "$25.03"],
            ["#RB7532", "افشین", "13 مهر, 1403", "$22.61"],
            ["#RB9632", "فرزاد", "12 مهر, 1403", "$24.05"],
            ["#RB7456", "غزل", "12 مهر, 1403", "$26.15"],
            ["#RB3002", "هادی", "12 مهر, 1403", "$21.25"],
            ["#RB9857", "سینا", "11 مهر, 1403", "$22.61"],
            ["#RB2589", "جاوید", "11 مهر, 1403", "$25.03"],
          ],
        }).render(document.getElementById("table-pagination")),
      document.getElementById("table-search") &&
        new gridjs.Grid({
          columns: ["نام", "ایمیل", "سمت", "شرکت", "کشور"],
          pagination: { limit: 5 },
          search: !0,
          data: [
            [
              "علی",
              "ali@example.com",
              "مهندس نرم‌افزار",
              "شرکت ABC",
              "ایالات متحده",
            ],
            [
              "باربد",
              "barbod@example.com",
              "مدیر محصول",
              "شرکت XYZ",
              "کانادا",
            ],
            [
              "بهنام",
              "behnam@example.com",
              "تحلیل‌گر داده",
              "شرکت 123",
              "استرالیا",
            ],
            [
              "داوود",
              "davood@example.com",
              "طراح UI/UX",
              "شرکت 456",
              "انگلستان",
            ],
            [
              "افشین",
              "afshin@example.com",
              "متخصص بازاریابی",
              "شرکت 789",
              "فرانسه",
            ],
            [
              "فرزاد",
              "farzad@example.com",
              "مدیر منابع انسانی",
              "شرکت ABC",
              "آلمان",
            ],
            [
              "غزل",
              "ghazal@example.com",
              "تحلیل‌گر مالی",
              "شرکت XYZ",
              "ژاپن",
            ],
            [
              "هادی",
              "hadi@example.com",
              "نماینده فروش",
              "شرکت 123",
              "برزیل",
            ],
            [
              "سینا",
              "sina@example.com",
              "برنامه‌نویس",
              "شرکت 456",
              "هند",
            ],
            [
              "جاوید",
              "javad@example.com",
              "مدیر عملیات",
              "شرکت 789",
              "چین",
            ],
          ],
        }).render(document.getElementById("table-search")),
      document.getElementById("table-sorting") &&
        new gridjs.Grid({
          columns: ["نام", "ایمیل", "سمت", "شرکت", "کشور"],
          pagination: { limit: 5 },
          sort: !0,
          data: [
            [
              "علی",
              "ali@example.com",
              "مهندس نرم‌افزار",
              "شرکت ABC",
              "ایالات متحده",
            ],
            [
              "باربد",
              "barbod@example.com",
              "مدیر محصول",
              "شرکت XYZ",
              "کانادا",
            ],
            [
              "بهنام",
              "behnam@example.com",
              "تحلیل‌گر داده",
              "شرکت 123",
              "استرالیا",
            ],
            [
              "داوود",
              "davood@example.com",
              "طراح UI/UX",
              "شرکت 456",
              "انگلستان",
            ],
            [
              "افشین",
              "afshin@example.com",
              "متخصص بازاریابی",
              "شرکت 789",
              "فرانسه",
            ],
            [
              "فرزاد",
              "farzad@example.com",
              "مدیر منابع انسانی",
              "شرکت ABC",
              "آلمان",
            ],
            [
              "غزل",
              "ghazal@example.com",
              "تحلیل‌گر مالی",
              "شرکت XYZ",
              "ژاپن",
            ],
            [
              "هادی",
              "hadi@example.com",
              "نماینده فروش",
              "شرکت 123",
              "برزیل",
            ],
            [
              "سینا",
              "sina@example.com",
              "برنامه‌نویس",
              "شرکت 456",
              "هند",
            ],
            [
              "جاوید",
              "javad@example.com",
              "مدیر عملیات",
              "شرکت 789",
              "چین",
            ],
          ],
        }).render(document.getElementById("table-sorting")),
      document.getElementById("table-loading-state") &&
        new gridjs.Grid({
          columns: ["نام", "ایمیل", "سمت", "شرکت", "کشور"],
          pagination: { limit: 5 },
          sort: !0,
          data: function () {
            return new Promise(function (e) {
              setTimeout(function () {
                e([
                  [
                    "علی",
                    "ali@example.com",
                    "مهندس نرم‌افزار",
                    "شرکت ABC",
                    "ایالات متحده",
                  ],
                  [
                    "باربد",
                    "barbod@example.com",
                    "مدیر محصول",
                    "شرکت XYZ",
                    "کانادا",
                  ],
                  [
                    "بهنام",
                    "behnam@example.com",
                    "تحلیل‌گر داده",
                    "شرکت 123",
                    "استرالیا",
                  ],
                  [
                    "داوود",
                    "davood@example.com",
                    "طراح UI/UX",
                    "شرکت 456",
                    "انگلستان",
                  ],
                  [
                    "افشین",
                    "afshin@example.com",
                    "متخصص بازاریابی",
                    "شرکت 789",
                    "فرانسه",
                  ],
                  [
                    "فرزاد",
                    "farzad@example.com",
                    "مدیر منابع انسانی",
                    "شرکت ABC",
                    "آلمان",
                  ],
                  [
                    "غزل",
                    "ghazal@example.com",
                    "تحلیل‌گر مالی",
                    "شرکت XYZ",
                    "ژاپن",
                  ],
                  [
                    "هادی",
                    "hadi@example.com",
                    "نماینده فروش",
                    "شرکت 123",
                    "برزیل",
                  ],
                  [
                    "سینا",
                    "sina@example.com",
                    "برنامه‌نویس",
                    "شرکت 456",
                    "هند",
                  ],
                  [
                    "جاوید",
                    "javad@example.com",
                    "مدیر عملیات",
                    "شرکت 789",
                    "چین",
                  ],
                ]);
              }, 2e3);
            });
          },
        }).render(document.getElementById("table-loading-state")),
      document.getElementById("table-fixed-header") &&
        new gridjs.Grid({
          columns: ["نام", "ایمیل", "سمت", "شرکت", "کشور"],
          sort: !0,
          pagination: !0,
          fixedHeader: !0,
          height: "400px",
          data: [
            [
              "علی",
              "ali@example.com",
              "مهندس نرم‌افزار",
              "شرکت ABC",
              "ایالات متحده",
            ],
            [
              "باربد",
              "barbod@example.com",
              "مدیر محصول",
              "شرکت XYZ",
              "کانادا",
            ],
            [
              "بهنام",
              "behnam@example.com",
              "تحلیل‌گر داده",
              "شرکت 123",
              "استرالیا",
            ],
            [
              "داوود",
              "davood@example.com",
              "طراح UI/UX",
              "شرکت 456",
              "انگلستان",
            ],
            [
              "افشین",
              "afshin@example.com",
              "متخصص بازاریابی",
              "شرکت 789",
              "فرانسه",
            ],
            [
              "فرزاد",
              "farzad@example.com",
              "مدیر منابع انسانی",
              "شرکت ABC",
              "آلمان",
            ],
            [
              "غزل",
              "ghazal@example.com",
              "تحلیل‌گر مالی",
              "شرکت XYZ",
              "ژاپن",
            ],
            [
              "هادی",
              "hadi@example.com",
              "نماینده فروش",
              "شرکت 123",
              "برزیل",
            ],
            [
              "سینا",
              "sina@example.com",
              "برنامه‌نویس",
              "شرکت 456",
              "هند",
            ],
            [
              "جاوید",
              "javad@example.com",
              "مدیر عملیات",
              "شرکت 789",
              "چین",
            ],
          ],
        }).render(document.getElementById("table-fixed-header")),
      document.getElementById("table-hidden-column") &&
        new gridjs.Grid({
          columns: [
            "نام",
            "ایمیل",
            "سمت",
            "شرکت",
            { name: "کشور", hidden: !0 },
          ],
          pagination: { limit: 5 },
          sort: !0,
          data: [
            [
              "علی",
              "ali@example.com",
              "مهندس نرم‌افزار",
              "شرکت ABC",
              "ایالات متحده",
            ],
            [
              "باربد",
              "barbod@example.com",
              "مدیر محصول",
              "شرکت XYZ",
              "کانادا",
            ],
            [
              "بهنام",
              "behnam@example.com",
              "تحلیل‌گر داده",
              "شرکت 123",
              "استرالیا",
            ],
            [
              "داوود",
              "davood@example.com",
              "طراح UI/UX",
              "شرکت 456",
              "انگلستان",
            ],
            [
              "افشین",
              "afshin@example.com",
              "متخصص بازاریابی",
              "شرکت 789",
              "فرانسه",
            ],
            [
              "فرزاد",
              "farzad@example.com",
              "مدیر منابع انسانی",
              "شرکت ABC",
              "آلمان",
            ],
            [
              "غزل",
              "ghazal@example.com",
              "تحلیل‌گر مالی",
              "شرکت XYZ",
              "ژاپن",
            ],
            [
              "هادی",
              "hadi@example.com",
              "نماینده فروش",
              "شرکت 123",
              "برزیل",
            ],
            [
              "سینا",
              "sina@example.com",
              "برنامه‌نویس",
              "شرکت 456",
              "هند",
            ],
            [
              "جاوید",
              "javad@example.com",
              "مدیر عملیات",
              "شرکت 789",
              "چین",
            ],
          ],
        }).render(document.getElementById("table-hidden-column"));
  }
}
document.addEventListener("DOMContentLoaded", function (e) {
  new GridDatatable().init();
});