var colors = ["#7dcc93"],
  options = {
    series: [
      {
        data: [
          {
            x: "کد",
            y: [
              new Date("2019-03-02").getTime(),
              new Date("2019-03-04").getTime(),
            ],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-04").getTime(),
              new Date("2019-03-08").getTime(),
            ],
          },
          {
            x: "اعتبارسنجی",
            y: [
              new Date("2019-03-08").getTime(),
              new Date("2019-03-12").getTime(),
            ],
          },
          {
            x: "استقرار",
            y: [
              new Date("2019-03-12").getTime(),
              new Date("2019-03-18").getTime(),
            ],
          },
        ],
      },
    ],
    chart: { height: 350, type: "rangeBar", toolbar: { show: !1 } },
    colors: colors,
    plotOptions: { bar: { horizontal: !0 } },
    xaxis: { type: "datetime" },
  },
  chart = new ApexCharts(document.querySelector("#basic-timeline"), options);
chart.render();
(colors = ["#4697ce", "#7f56da", "#e06d94", "#f8ac59", "#7dcc93"]),
  (options = {
    series: [
      {
        data: [
          {
            x: "آنالیز",
            y: [
              new Date("2019-02-27").getTime(),
              new Date("2019-03-04").getTime(),
            ],
            fillColor: colors[0],
          },
          {
            x: "طرح",
            y: [
              new Date("2019-03-04").getTime(),
              new Date("2019-03-08").getTime(),
            ],
            fillColor: colors[1],
          },
          {
            x: "کدزنی",
            y: [
              new Date("2019-03-07").getTime(),
              new Date("2019-03-10").getTime(),
            ],
            fillColor: colors[2],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-08").getTime(),
              new Date("2019-03-12").getTime(),
            ],
            fillColor: colors[3],
          },
          {
            x: "استقرار",
            y: [
              new Date("2019-03-12").getTime(),
              new Date("2019-03-17").getTime(),
            ],
            fillColor: colors[4],
          },
        ],
      },
    ],
    chart: { height: 350, type: "rangeBar", toolbar: { show: !1 } },
    plotOptions: {
      bar: {
        horizontal: !0,
        distributed: !0,
        dataLabels: { hideOverflowingLabels: !1 },
      },
    },
    dataLabels: {
      enabled: !0,
      formatter: function (e, t) {
        var a = t.w.globals.labels[t.dataPointIndex],
          t = moment(e[0]),
          t = moment(e[1]).diff(t, "روز");
        return a + ": " + t + (1 < t ? " روز" : " day");
      },
      style: { colors: ["#f3f4f5", "#fff"] },
    },
    xaxis: { type: "datetime" },
    yaxis: { show: !1 },
    grid: {
      row: { colors: ["#f3f4f5", "#fff"], opacity: 1 },
      padding: { top: -15, right: 10, bottom: -15, left: -10 },
    },
  });
(chart = new ApexCharts(
  document.querySelector("#distributed-timeline"),
  options
)).render();
(colors = ["#e06d94", "#f8ac59"]),
  (options = {
    series: [
      {
        name: "باربد",
        data: [
          {
            x: "طرح",
            y: [
              new Date("2019-03-05").getTime(),
              new Date("2019-03-08").getTime(),
            ],
          },
          {
            x: "کد",
            y: [
              new Date("2019-03-08").getTime(),
              new Date("2019-03-11").getTime(),
            ],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-11").getTime(),
              new Date("2019-03-16").getTime(),
            ],
          },
        ],
      },
      {
        name: "ایلیا",
        data: [
          {
            x: "طرح",
            y: [
              new Date("2019-03-02").getTime(),
              new Date("2019-03-05").getTime(),
            ],
          },
          {
            x: "کد",
            y: [
              new Date("2019-03-06").getTime(),
              new Date("2019-03-09").getTime(),
            ],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-10").getTime(),
              new Date("2019-03-19").getTime(),
            ],
          },
        ],
      },
    ],
    chart: { height: 350, type: "rangeBar", toolbar: { show: !1 } },
    plotOptions: { bar: { horizontal: !0 } },
    dataLabels: {
      enabled: !0,
      formatter: function (e) {
        var t = moment(e[0]),
          t = moment(e[1]).diff(t, "روز");
        return t + (1 < t ? " روز" : " day");
      },
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0.25,
        gradientToColors: void 0,
        inverseColors: !0,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [50, 0, 100, 100],
      },
    },
    colors: colors,
    xaxis: { type: "datetime" },
    legend: { position: "top" },
  });
(chart = new ApexCharts(
  document.querySelector("#multi-series-timeline"),
  options
)).render();
(colors = ["#e06d94", "#f8ac59", "#7dcc93"]),
  (options = {
    series: [
      {
        name: "باربد",
        data: [
          {
            x: "طرح",
            y: [
              new Date("2019-03-05").getTime(),
              new Date("2019-03-08").getTime(),
            ],
          },
          {
            x: "کد",
            y: [
              new Date("2019-03-02").getTime(),
              new Date("2019-03-05").getTime(),
            ],
          },
          {
            x: "کد",
            y: [
              new Date("2019-03-05").getTime(),
              new Date("2019-03-07").getTime(),
            ],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-03").getTime(),
              new Date("2019-03-09").getTime(),
            ],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-08").getTime(),
              new Date("2019-03-11").getTime(),
            ],
          },
          {
            x: "اعتبارسنجی",
            y: [
              new Date("2019-03-11").getTime(),
              new Date("2019-03-16").getTime(),
            ],
          },
          {
            x: "طرح",
            y: [
              new Date("2019-03-01").getTime(),
              new Date("2019-03-03").getTime(),
            ],
          },
        ],
      },
      {
        name: "ایلیا",
        data: [
          {
            x: "طرح",
            y: [
              new Date("2019-03-02").getTime(),
              new Date("2019-03-05").getTime(),
            ],
          },
          {
            x: "تست",
            y: [
              new Date("2019-03-06").getTime(),
              new Date("2019-03-16").getTime(),
            ],
            goals: [
              {
                name: "Break",
                value: new Date("2019-03-10").getTime(),
                strokeColor: "#CD2F2A",
              },
            ],
          },
          {
            x: "کد",
            y: [
              new Date("2019-03-03").getTime(),
              new Date("2019-03-07").getTime(),
            ],
          },
          {
            x: "استقرار",
            y: [
              new Date("2019-03-20").getTime(),
              new Date("2019-03-22").getTime(),
            ],
          },
          {
            x: "طرح",
            y: [
              new Date("2019-03-10").getTime(),
              new Date("2019-03-16").getTime(),
            ],
          },
        ],
      },
      {
        name: "دانیال",
        data: [
          {
            x: "کد",
            y: [
              new Date("2019-03-10").getTime(),
              new Date("2019-03-17").getTime(),
            ],
          },
          {
            x: "اعتبارسنجی",
            y: [
              new Date("2019-03-05").getTime(),
              new Date("2019-03-09").getTime(),
            ],
            goals: [
              {
                name: "Break",
                value: new Date("2019-03-07").getTime(),
                strokeColor: "#CD2F2A",
              },
            ],
          },
        ],
      },
    ],
    chart: { height: 350, type: "rangeBar", toolbar: { show: !1 } },
    plotOptions: { bar: { horizontal: !0, barHeight: "80%" } },
    xaxis: { type: "datetime" },
    stroke: { width: 1 },
    colors: colors,
    fill: { type: "solid", opacity: 0.6 },
    legend: { position: "top", horizontalAlign: "left" },
  });
(chart = new ApexCharts(
  document.querySelector("#advanced-timeline"),
  options
)).render();
(colors = ["#4697ce", "#7f56da", "#e06d94", "#f8ac59", "#7dcc93"]),
  (options = {
    series: [
  {
    name: "علی رضایی",
    data: [
      {
        x: "رییس",
        y: [
          new Date(1789, 3, 30).getTime(),
          new Date(1797, 2, 4).getTime(),
        ],
      },
    ],
  },
  {
    name: "حسین کاظمی",
    data: [
      {
        x: "رییس",
        y: [new Date(1797, 2, 4).getTime(), new Date(1801, 2, 4).getTime()],
      },
      {
        x: "معاون",
        y: [
          new Date(1789, 3, 21).getTime(),
          new Date(1797, 2, 4).getTime(),
        ],
      },
    ],
  },
  {
    name: "مهدی احمدی",
    data: [
      {
        x: "رییس",
        y: [new Date(1801, 2, 4).getTime(), new Date(1809, 2, 4).getTime()],
      },
      {
        x: "معاون",
        y: [new Date(1797, 2, 4).getTime(), new Date(1801, 2, 4).getTime()],
      },
      {
        x: "وزیر",
        y: [
          new Date(1790, 2, 22).getTime(),
          new Date(1793, 11, 31).getTime(),
        ],
      },
    ],
  },
  {
    name: "رضا مرادی",
    data: [
      {
        x: "معاون",
        y: [new Date(1801, 2, 4).getTime(), new Date(1805, 2, 4).getTime()],
      },
    ],
  },
  {
    name: "کمال موسوی",
    data: [
      {
        x: "معاون",
        y: [
          new Date(1805, 2, 4).getTime(),
          new Date(1812, 3, 20).getTime(),
        ],
      },
    ],
  },
  {
    name: "فرهاد نصیری",
    data: [
      {
        x: "وزیر",
        y: [
          new Date(1789, 8, 25).getTime(),
          new Date(1790, 2, 22).getTime(),
        ],
      },
    ],
  },
  {
    name: "محمد شریفی",
    data: [
      {
        x: "وزیر",
        y: [
          new Date(1794, 0, 2).getTime(),
          new Date(1795, 7, 20).getTime(),
        ],
      },
    ],
  },
  {
    name: "سعید نادری",
    data: [
      {
        x: "وزیر",
        y: [
          new Date(1795, 7, 20).getTime(),
          new Date(1800, 4, 12).getTime(),
        ],
      },
    ],
  },
  {
    name: "بهمن قاسمی",
    data: [
      {
        x: "وزیر",
        y: [
          new Date(1800, 4, 13).getTime(),
          new Date(1800, 5, 5).getTime(),
        ],
      },
    ],
  },
  {
    name: "حمید کریمی",
    data: [
      {
        x: "وزیر",
        y: [
          new Date(1800, 5, 13).getTime(),
          new Date(1801, 2, 4).getTime(),
        ],
      },
    ],
  },
  {
    name: "میلاد صفری",
    data: [
      {
        x: "وزیر",
        y: [new Date(1801, 2, 5).getTime(), new Date(1801, 4, 1).getTime()],
      },
    ],
  },
  {
    name: "آرمان جعفری",
    data: [
      {
        x: "وزیر",
        y: [new Date(1801, 4, 2).getTime(), new Date(1809, 2, 3).getTime()],
      },
    ],
  },
],
    chart: { height: 350, type: "rangeBar", toolbar: { show: !1 } },
    plotOptions: {
      bar: { horizontal: !0, barHeight: "50%", rangeBarGroupRows: !0 },
    },
    colors: colors,
    fill: { type: "solid" },
    xaxis: { type: "datetime" },
    legend: { position: "right" },
  });
(chart = new ApexCharts(
  document.querySelector("#group-rows-timeline"),
  options
)).render();
