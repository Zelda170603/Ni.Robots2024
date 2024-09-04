import ApexCharts from 'apexcharts';

const getMainChartOptions = () => {
    let mainChartColors = {};

    if (document.documentElement.classList.contains('dark')) {
        mainChartColors = {
            borderColor: '#374151',
            labelColor: '#9CA3AF',
            opacityFrom: 0,
            opacityTo: 0.15,
        };
    } else {
        mainChartColors = {
            borderColor: '#F3F4F6',
            labelColor: '#6B7280',
            opacityFrom: 0.45,
            opacityTo: 0,
        }
    }

    return {
        chart: {
            height: 420,
            type: 'area',
            fontFamily: 'Inter, sans-serif',
            foreColor: mainChartColors.labelColor,
            toolbar: {
                show: false
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                enabled: true,
                opacityFrom: mainChartColors.opacityFrom,
                opacityTo: mainChartColors.opacityTo
            }
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            style: {
                fontSize: '14px',
                fontFamily: 'Inter, sans-serif',
            },
        },
        grid: {
            show: true,
            borderColor: mainChartColors.borderColor,
            strokeDashArray: 1,
            padding: {
                left: 35,
                bottom: 15
            }
        },
        series: [
            {
                name: 'Revenue',
                data: [6356, 6218, 6156, 6526, 6356, 6256, 6056],
                color: '#1A56DB'
            },
            {
                name: 'Revenue (previous period)',
                data: [6556, 6725, 6424, 6356, 6586, 6756, 6616],
                color: '#FDBA8C'
            }
        ],
        markers: {
            size: 5,
            strokeColors: '#ffffff',
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        },
        xaxis: {
            categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
            labels: {
                style: {
                    colors: [mainChartColors.labelColor],
                    fontSize: '14px',
                    fontWeight: 500,
                },
            },
            axisBorder: {
                color: mainChartColors.borderColor,
            },
            axisTicks: {
                color: mainChartColors.borderColor,
            },
            crosshairs: {
                show: true,
                position: 'back',
                stroke: {
                    color: mainChartColors.borderColor,
                    width: 1,
                    dashArray: 10,
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: [mainChartColors.labelColor],
                    fontSize: '14px',
                    fontWeight: 500,
                },
                formatter: function (value) {
                    return '$' + value;
                }
            },
        },
        legend: {
            fontSize: '14px',
            fontWeight: 500,
            fontFamily: 'Inter, sans-serif',
            labels: {
                colors: [mainChartColors.labelColor]
            },
            itemMargin: {
                horizontal: 10
            }
        },
        responsive: [
            {
                breakpoint: 1024,
                options: {
                    xaxis: {
                        labels: {
                            show: false
                        }
                    }
                }
            }
        ]
    };
}

if (document.getElementById('main-chart')) {
    const chart = new ApexCharts(document.getElementById('main-chart'), getMainChartOptions());
    chart.render();

    document.addEventListener('dark-mode', function () {
        chart.updateOptions(getMainChartOptions());
    });
}

if (document.getElementById('new-products-chart')) {
    const options = {
        colors: ['#1A56DB', '#FDBA8C'],
        series: [
            {
                name: 'Quantity',
                color: '#1A56DB',
                data: [
                    { x: '01 Feb', y: 170 },
                    { x: '02 Feb', y: 180 },
                    { x: '03 Feb', y: 164 },
                    { x: '04 Feb', y: 145 },
                    { x: '05 Feb', y: 194 },
                    { x: '06 Feb', y: 170 },
                    { x: '07 Feb', y: 155 },
                ]
            }
        ],
        chart: {
            type: 'bar',
            height: '140px',
            fontFamily: 'Inter, sans-serif',
            foreColor: '#4B5563',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '90%',
                borderRadius: 3
            }
        },
        tooltip: {
            shared : false,
            intersect: false,
            style: {
                fontSize: '14px',
                fontFamily: 'Inter, sans-serif'
            },
        },
        states: {
            hover: {
                filter: {
                    type: 'darken',
                    value: 1
                }
            }
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['transparent']
        },
        grid: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            labels: {
                style: {
                    colors: ['#6B7280'],
                    fontSize: '14px',
                    fontWeight: 500,
                },
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
        },
        yaxis: {
            show: false
        },
        fill: {
            opacity: 1
        }
    };

    const chart = new ApexCharts(document.getElementById('new-products-chart'), options);
    chart.render();
}

if (document.getElementById('sales-by-category')) {
    const options = {
        colors: ['#1A56DB', '#FDBA8C'],
        series: [
            {
                name: 'Desktop PC',
                color: '#1A56DB',
                data: [
                    { x: '01 Feb', y: 170 },
                    { x: '02 Feb', y: 180 },
                    { x: '03 Feb', y: 164 },
                    { x: '04 Feb', y: 145 },
                    { x: '05 Feb', y: 194 },
                    { x: '06 Feb', y: 170 },
                    { x: '07 Feb', y: 155 },
                ]
            },
            {
                name: 'Phones',
                color: '#FDBA8C',
                data: [
                    { x: '01 Feb', y: 120 },
                    { x: '02 Feb', y: 294 },
                    { x: '03 Feb', y: 267 },
                    { x: '04 Feb', y: 245 },
                    { x: '05 Feb', y: 334 },
                    { x: '06 Feb', y: 275 },
                    { x: '07 Feb', y: 188 },
                ]
            }
        ],
        chart: {
            height: '340px',
            type: 'bar',
            stacked: true,
            fontFamily: 'Inter, sans-serif',
            foreColor: '#4B5563',
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 5,
                columnWidth: '30%'
            }
        },
        tooltip: {
            shared : false,
            intersect: false,
            style: {
                fontSize: '14px',
                fontFamily: 'Inter, sans-serif'
            },
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            fontSize: '14px',
            fontWeight: 500,
            fontFamily: 'Inter, sans-serif',
            labels: {
                colors: ['#6B7280']
            },
            itemMargin: {
                horizontal: 10
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: ['#6B7280'],
                    fontSize: '14px',
                    fontWeight: 500,
                },
            },
            axisBorder: {
                color: '#E5E7EB',
            },
            axisTicks: {
                color: '#E5E7EB',
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: ['#6B7280'],
                    fontSize: '14px',
                    fontWeight: 500,
                },
                formatter: function (value) {
                    return '$' + value;
                }
            },
        },
        grid: {
            borderColor: '#E5E7EB',
            strokeDashArray: 5,
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    };

    const chart = new ApexCharts(document.getElementById('sales-by-category'), options);
    chart.render();
}
