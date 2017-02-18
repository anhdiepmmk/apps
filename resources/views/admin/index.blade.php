@extends('admin.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <script>
                init.push(function () {
                    $('#dashboard-support-tickets .panel-body > div').slimScroll({
                        height: 620,
                        alwaysVisible: true,
                        color: '#888',
                        allowPageScroll: true
                    });
                })
            </script>

            <div class="panel panel-success widget-support-tickets" id="dashboard-support-tickets">
                <div class="panel-heading">
                    <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Top Download</span>

                </div>
                <!-- / .panel-heading -->
                <div class="panel-body tab-content-padding">
                    <!-- Panel padding, without vertical padding -->
                    <div class="panel-padding no-padding-vr">

                        @foreach($top_dl as $row)
                            <div class="ticket">
                                <a href="#" title="" class="ticket-title">{{ $row->name }}<span>[{{ $row->numDownloads }}]</span></a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- / .panel-body -->
            </div>
            <!-- / .panel -->
        </div>

        <div class="col-xs-12 col-sm-8">
            <script>
                init.push(function () {
                    $('#recent_dl .panel-body > div').slimScroll({
                        height: 390,
                        alwaysVisible: true,
                        color: '#888',
                        allowPageScroll: true
                    });
                })
            </script>
            <script>
                init.push(function () {
                    var downloads_data = [
                        { day: '2014-03-10', dl: 20 },
                        { day: '2014-03-11', dl: 10 },
                        { day: '2014-03-12', dl: 15 },
                        { day: '2014-03-13', dl: 12 },
                        { day: '2014-03-14', dl: 5  },
                        { day: '2014-03-15', dl: 5  },
                        { day: '2014-03-16', dl: 20 }
                    ];
                    //var downloads_data2 = "<?php echo json_encode($downloads_data) ?>";

                    var downloads_data = [
                                            { day: '<?php echo $downloads_data[6]['day'] ?>', dl: '<?php echo $downloads_data[6]['dl'] ?>' },
                                            { day: '<?php echo $downloads_data[5]['day'] ?>', dl: '<?php echo $downloads_data[5]['dl'] ?>' },
                                            { day: '<?php echo $downloads_data[4]['day'] ?>', dl: '<?php echo $downloads_data[4]['dl'] ?>' },
                                            { day: '<?php echo $downloads_data[3]['day'] ?>', dl: '<?php echo $downloads_data[3]['dl'] ?>' },
                                            { day: '<?php echo $downloads_data[2]['day'] ?>', dl: '<?php echo $downloads_data[2]['dl'] ?>'  },
                                            { day: '<?php echo $downloads_data[1]['day'] ?>', dl: '<?php echo $downloads_data[1]['dl'] ?>'  },
                                            { day: '<?php echo $downloads_data[0]['day'] ?>', dl: '<?php echo $downloads_data[0]['dl'] ?>' }
                                        ];


                    Morris.Line({
                        element: 'hero-graph',
                        data: downloads_data,
                        xkey: 'day',
                        ykeys: ['dl'],
                        labels: ['Downloads'],
                        lineColors: ['#fff'],
                        lineWidth: 2,
                        pointSize: 4,
                        gridLineColor: 'rgba(255,255,255,.5)',
                        resize: true,
                        gridTextColor: '#fff',
                        xLabels: "day",
                        xLabelFormat: function(d) {
                            return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                        },
                    });
                });
            </script>
            <!-- / Javascript -->

            <div class="bg-primary padding-sm valign-middle" style="margin-bottom: 10px">
                <div id="hero-graph" class="graph" style="height: 200px;"></div>
            </div>

            <div class="panel panel-success widget-support-tickets" id="recent_dl">
                <div class="panel-heading">
                    <span class="panel-title"><i class="panel-title-icon fa fa-fire text-danger"></i>Recent Download</span>
                    <div class="panel-heading-controls">
                        <div class="panel-heading-text">Today: {{ $dlToday->count() }}</div>
                    </div>
                </div>
                <!-- / .panel-heading -->
                <div class="panel-body tab-content-padding">
                    <!-- Panel padding, without vertical padding -->
                    <div class="panel-padding no-padding-vr">

                        @foreach($recent_dl as $row)
                            <span class="ticket-label">[{{ $row->server }}]</span>
                            <span class="ticket-label">{{ $row->created_at->format('H:i:s d/m/Y') }}</span>
                            <span class="ticket-label">{{ $row->country_name }}</span>

                            <div class="ticket">
                                <a href="#" title="" class="ticket-title">{{ @$row->app->name.' '.@$row->appversion->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- / .panel-body -->
            </div>
            <!-- / .panel -->
        </div>
    </div>

@endsection