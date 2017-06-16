@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
                        <script>
                            var x = (name.split(','));
                            var data = [{
                                x: x,
                                y: num,
                                type: 'bar'
                            }];

                            Plotly.newPlot('myDiv', data);
                        </script>
                        Statistics are collected!

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Information</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            @foreach($statistics as $statistic)
                                <tbody>
                                <tr>
                                    <td>{{ $statistic->id }}</td>
                                    <td>{{ $statistic->info }}</td>
                                    <td>{{ $statistic->date }}</td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="ct-chart" id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
