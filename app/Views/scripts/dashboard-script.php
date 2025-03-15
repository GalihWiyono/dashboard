<script>
    $(document).ready(function() {

        fetchData();

        function fetchData() {
            $.ajax({
                url: 'dashboard/getchart',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#issueCount').text(response.issues);
                    $('#commentCount').text(response.comments);
                    $('#userCount').text(response.users);
                    renderChart(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // function dataTotalPendaftaran(dataPendaftaran) {
        //     var yourJsonData = [{
        //             "nama": "TestEvent",
        //             "total": 1
        //         },
        //         {
        //             "nama": "Geopark Ciletuh Run",
        //             "total": 2
        //         }
        //     ];

        //     Highcharts.chart('container-pendaftaran', {
        //         chart: {
        //             type: 'column'
        //         },
        //         title: {
        //             text: 'Total Pendaftaran per Event'
        //         },
        //         xAxis: {
        //             categories: dataPendaftaran.map(item => item.nama_event), // Menggunakan nama event dari data JSON
        //             crosshair: true,
        //             accessibility: {
        //                 description: 'Events'
        //             }
        //         },
        //         yAxis: {
        //             min: 0,
        //             title: {
        //                 text: 'Total'
        //             }
        //         },
        //         tooltip: {
        //             valueSuffix: ' (Pendaftar)'
        //         },
        //         plotOptions: {
        //             column: {
        //                 pointPadding: 0.2,
        //                 borderWidth: 0
        //             }
        //         },
        //         series: [{
        //             name: 'Total Pendaftaran',
        //             data: dataPendaftaran.map(item => parseInt(item.total_pendaftaran)) // Menggunakan total dari data JSON
        //         }]
        //     });

        // }

        // function dataTotalPeserta(dataPeserta) {
        //     Highcharts.chart('container-peserta', {
        //         chart: {
        //             type: 'column'
        //         },
        //         title: {
        //             text: 'Total Peserta per Event'
        //         },
        //         xAxis: {
        //             categories: dataPeserta.map(item => item.nama_event), // Menggunakan nama event dari data JSON
        //             crosshair: true,
        //             accessibility: {
        //                 description: 'Events'
        //             }
        //         },
        //         yAxis: {
        //             min: 0,
        //             title: {
        //                 text: 'Total'
        //             }
        //         },
        //         tooltip: {
        //             valueSuffix: ' (Orang)'
        //         },
        //         plotOptions: {
        //             column: {
        //                 pointPadding: 0.2,
        //                 borderWidth: 0
        //             }
        //         },
        //         series: [{
        //             name: 'Total Peserta',
        //             data: dataPeserta.map(item => parseInt(item.total_peserta)) // Menggunakan total dari data JSON
        //         }]
        //     });

        // }

        // function dataTotalPenjualan(dataPenjualan) {
        //     // var yourJsonData = [{
        //     //         "nama": "TestEvent",
        //     //         "total": 1000000
        //     //     },
        //     //     {
        //     //         "nama": "Geopark Ciletuh Run",
        //     //         "total": 1000000
        //     //     }
        //     // ];

        //     Dashboards.board('container-total-penjualan', {
        //         dataPool: {
        //             dataSources: [{
        //                 id: 'Event',
        //                 type: 'JSON',
        //                 options: {
        //                     data: dataPenjualan
        //                 }
        //             }]
        //         },
        //         gui: {
        //             layouts: [{
        //                 rows: [{
        //                     cells: [{
        //                             id: 'top-left',
        //                             responsive: {
        //                                 small: {
        //                                     width: '100%'
        //                                 }
        //                             }
        //                         },
        //                         {
        //                             id: 'top-right',
        //                             responsive: {
        //                                 small: {
        //                                     width: '100%'
        //                                 }
        //                             }
        //                         }
        //                     ]
        //                 }]
        //             }]
        //         },
        //         components: [{
        //                 cell: 'top-left',
        //                 type: 'Highcharts',
        //                 sync: {
        //                     highlight: true
        //                 },
        //                 dataSource: {
        //                     id: 'Event'
        //                 },
        //                 chartOptions: {
        //                     chart: {
        //                         type: 'bar'
        //                     },
        //                     credits: {
        //                         enabled: false
        //                     },
        //                     legend: {
        //                         enabled: false
        //                     },
        //                     plotOptions: {
        //                         series: {
        //                             colorByPoint: true
        //                         }
        //                     },
        //                     title: {
        //                         text: 'Total Pendapatan per Event'
        //                     },
        //                     xAxis: {
        //                         categories: dataPenjualan.map(item => item.nama_event), // Set categories based on 'nama'
        //                     },
        //                     yAxis: {
        //                         title: {
        //                             text: 'Total Pendapatan'
        //                         }
        //                     },
        //                     series: [{ // Set series data based on 'total'
        //                         name: 'Total',
        //                         data: dataPenjualan.map(item => parseInt(item.total_pendapatan))
        //                     }]
        //                 }
        //             },
        //             {
        //                 cell: 'top-right',
        //                 type: 'Highcharts',
        //                 sync: {
        //                     highlight: true
        //                 },
        //                 dataSource: {
        //                     id: 'Event'
        //                 },
        //                 chartOptions: {
        //                     chart: {
        //                         type: 'pie'
        //                     },
        //                     credits: {
        //                         enabled: false
        //                     },
        //                     legend: {
        //                         enabled: true
        //                     },
        //                     plotOptions: {
        //                         pie: {
        //                             innerSize: '0%',
        //                             allowPointSelect: true,
        //                             cursor: 'pointer',
        //                             dataLabels: {
        //                                 enabled: true,
        //                                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        //                             }
        //                         }
        //                     },
        //                     title: {
        //                         text: 'Total Distribusi Pendapatan per Event'
        //                     },
        //                     series: [{
        //                         name: 'Total',
        //                         colorByPoint: true,
        //                         data: dataPenjualan.map(item => ({
        //                             name: item.nama_event,
        //                             y: parseInt(item.total_pendapatan)
        //                         }))
        //                     }]
        //                 }
        //             }
        //         ]
        //     });
        // }

        function renderChart(data) {
            Highcharts.chart('container-chart', {
                chart: {
                    type: 'pie',
                },
                title: {
                    text: 'All Activity Overview'
                },
                tooltip: {
                    valueSuffix: '%'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.percentage:.1f}%',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: [{
                            name: 'Users',
                            y: data.users
                        },
                        {
                            name: 'Admin Comments',
                            sliced: true,
                            selected: true,
                            y: data.comments
                        },
                        {
                            name: 'Issues',
                            y: data.issues
                        }
                    ]
                }]
            });
        }


        console.log("Dashboard Ready");
        if ($('#toastNotification').hasClass("show")) {
            if ($('#toast-header').hasClass("bg-success")) {
                setTimeout(function() {
                    $('#toastNotification').toast('hide');
                }, 2000);
            }

            if ($('#toast-header').hasClass("bg-danger")) {
                setTimeout(function() {
                    $('#toastNotification').toast('hide');
                }, 10000);
            }
        }
    });
</script>