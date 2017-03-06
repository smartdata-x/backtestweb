
var myChart = echarts.init(document.getElementById('income-analyze'));
option = {
    title: {
        text: '收益分析'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['沪深','账户1','账户2','账户3','账户4','账户5']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['2-23','2-24','2-27','2-28','3-01','3-02','3-03']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'沪深',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'账户1',
            type:'line',
            stack: '总量',
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'账户2',
            type:'line',
            stack: '总量',
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'账户3',
            type:'line',
            stack: '总量',
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'账户4',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        },
        {
            name:'账户5',
            type:'line',
            stack: '总量',
            data:[240, 560, 780, 190, 690, 860, 480]
        }
    ]
};
myChart.setOption(option);