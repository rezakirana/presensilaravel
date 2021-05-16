<html>
    <head>

    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <table id="table3" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>PERINGKAT</th>
                            <th>ALTERNATIF</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ranking as $key => $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->alternatif }}</td>
                                <td>{{ $k->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
