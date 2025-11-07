var colors = ["#4697ce"],
  options = {
    series: [
      {
        data: [
            { x: "دهلی نو", y: 218 },
            { x: "کلکته", y: 149 },
            { x: "بمبئی", y: 184 },
            { x: "احمدآباد", y: 55 },
            { x: "بنگالورو", y: 84 },
            { x: "پونا", y: 31 },
            { x: "چنای", y: 70 },
            { x: "جیپور", y: 30 },
            { x: "سورات", y: 44 },
            { x: "حیدرآباد", y: 68 },
            { x: "لکنهو", y: 28 },
            { x: "ایندور", y: 19 },
            { x: "کانپور", y: 29 },
            ],
      },
    ],
    colors: colors,
    legend: { show: !1 },
    chart: { toolbar: { show: !1 }, height: 350, type: "treemap" },
    title: { text: "نقشه درختی ساده", align: "center" },
  },
  chart = new ApexCharts(document.querySelector("#basic-treemap"), options);
chart.render();
options = {
  series: [
  {
    name: "دسکتاپ ها",
    data: [
      { x: "101", y: 10 },
      { x: "102", y: 60 },
      { x: "103", y: 41 },
    ],
  },
  {
    name: "موبایل",
    data: [
      { x: "201", y: 10 },
      { x: "202", y: 20 },
      { x: "203", y: 51 },
      { x: "204", y: 30 },
      { x: "205", y: 20 },
      { x: "206", y: 30 },
    ],
  },
],
  legend: { show: !1 },
  chart: { toolbar: { show: !1 }, height: 350, type: "treemap" },
  colors: (colors = ["#f9b931", "#1bb394"]),
  title: { text: "نقشه درختی چند بعدی", align: "center" },
};
(chart = new ApexCharts(
  document.querySelector("#multiple-treemap"),
  options
)).render();
options = {
  series: [
    {
      data: [
  { x: "دهلی نو", y: 218 },
  { x: "کلکته", y: 149 },
  { x: "بمبئی", y: 184 },
  { x: "احمدآباد", y: 55 },
  { x: "بنگالورو", y: 84 },
  { x: "پونا", y: 31 },
  { x: "چنای", y: 70 },
  { x: "جیپور", y: 30 },
  { x: "سورات", y: 44 },
  { x: "حیدرآباد", y: 68 },
  { x: "لکنهو", y: 28 },
  { x: "ایندور", y: 19 },
  { x: "کانپور", y: 29 },
],
    },
  ],
  legend: { show: !1 },
  chart: { toolbar: { show: !1 }, height: 350, type: "treemap" },
  title: {
    text: "نقشه درختی توزیع‌شده (رنگ متفاوت برای هر سلول)",
    align: "center",
  },
  colors: (colors = [
    "#4697ce",
    "#53389f",
    "#7f56da",
    "#ff86c8",
    "#ed5565",
    "#23c6c8",
    "#f9b931",
    "#1bb394",
    "#2a668b",
    "#35ba44",
    "#4ccedd",
    "#23c880",
    "#ed8055",
  ]),
  plotOptions: { treemap: { distributed: !0, enableShades: !1 } },
};
(chart = new ApexCharts(
  document.querySelector("#distributed-treemap"),
  options
)).render();
options = {
  series: [
    {
      data: [
  { x: "872", y: 1.2 },
  { x: "64", y: 0.4 },
  { x: "392", y: -1.4 },
  { x: "58", y: 2.7 },
  { x: "715", y: -0.3 },
  { x: "2409", y: 5.1 },
  { x: "1834", y: -2.3 },
  { x: "921", y: 2.1 },
  { x: "47", y: 0.3 },
  { x: "532", y: 0.12 },
  { x: "874", y: -2.31 },
  { x: "652", y: 3.98 },
  { x: "4019", y: 1.67 },
],
    },
  ],
  legend: { show: !1 },
  chart: { toolbar: { show: !1 }, height: 350, type: "treemap" },
  title: { text: "نقشه درختی با مقیاس رنگی", align: "center" },
  dataLabels: {
    enabled: !0,
    style: { fontSize: "12px" },
    formatter: function (e, t) {
      return [e, t.value];
    },
    offsetY: -4,
  },
  plotOptions: {
    treemap: {
      enableShades: !0,
      shadeIntensity: 0.5,
      reverseNegativeShade: !0,
      colorScale: {
        ranges: [
          { from: -6, to: 0, color: (colors = ["#4697ce", "#1bb394"])[0] },
          { from: 0.001, to: 6, color: colors[1] },
        ],
      },
    },
  },
};
(chart = new ApexCharts(
  document.querySelector("#color-range-treemap"),
  options
)).render();
