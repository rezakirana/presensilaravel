
@extends('master')
@section('content')
    <section class="Feautes section" style="background-color: white; background-image: linear-gradient(white, #99ffbb);"><hr class="line1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tiles" style="margin-top:10px;height: 231px;overflow: auto;padding-right: 5px;padding-left: 5px;margin-right: 0 !important;position: relative;min-height: 1px;border-radius: 0 !important;box-sizing: border-box;display: block;direction: ltr;">
                    <center>
                        @foreach ($backdate as $item)
                            @if ($item['labelDay'] == 'Minggu')
                                <div class="tile bg-green-turquoise bg-red-sunglo" style="width:120px;height:120px;display: block;letter-spacing: 0.02em;float: left;height: 135px;width: 135px;cursor: pointer;text-decoration: none;color: #ffffff;position: relative;font-weight: 300;font-size: 12px;letter-spacing: 0.02em;line-height: 20px;overflow: hidden;border: 4px solid transparent;margin: 0 10px 10px 0;border-color: #e26a6a !important;background-image: none !important;background-color: #e26a6a !important;color: white !important;border-radius: 0 !important;box-sizing: border-box;">
                                    <div class="corner" style="float: left; font-weight: bold;padding: 0 5px;border-radius: 0 !important;">
                                        <span>{{ $item['labelDay'] }}</span>
                                    </div>
                                    <div class="check"></div>
                                    <div class="tile-body" style="overflow:initial;height: 100%;vertical-align: top;padding: 10px 10px;overflow: hidden;position: relative;font-weight: 400;font-size: 12px;color: #000000;color: #ffffff;margin-bottom: 10px;margin-bottom: 0 !important;">
                                        <i style="font-style:normal;margin-top: 17px;display: block;font-size: 56px;line-height: 56px;text-align: center;margin-left: -10px;">{{ $item['day'] }}</i>
                                    </div>
                                    <div class="tile-object" style="position: absolute;bottom: 0 !important;left: 0;right: 0;min-height: 30px;background-color: transparent;*zoom: 1;background: black !important;opacity: 0.8 !important;bottom: 7% !important;">
                                        <div class="name" style="position: absolute;bottom: 0;left: 0;margin-bottom: 5px;margin-left: 10px;margin-right: 15px;font-weight: 400;font-size: 13px;color: #ffffff;">{{ $item['month'] }}</div>
                                        <div class="number" style="position: absolute;bottom: 0;right: 0;margin-bottom: 0;color: #ffffff;text-align: center;font-weight: 600;font-size: 14px;letter-spacing: 0.01em;line-height: 14px;margin-bottom: 8px;margin-right: 10px;">{{ $item['year'] }}</div>
                                    </div>
                                </div>    
                            @else
                                <div class="tile bg-green-turquoise bg-red-sunglo" style="width:120px;height:120px;display: block;letter-spacing: 0.02em;float: left;height: 135px;width: 135px;cursor: pointer;text-decoration: none;color: #ffffff;position: relative;font-weight: 300;font-size: 12px;letter-spacing: 0.02em;line-height: 20px;overflow: hidden;border: 4px solid transparent;margin: 0 10px 10px 0;border-color: #36d7b7 !important;background-image: none !important;background-color: #36d7b7 !important;color: white !important;border-radius: 0 !important;box-sizing: border-box;">
                                    <div class="corner" style="float: left; font-weight: bold;padding: 0 5px;border-radius: 0 !important;">
                                        <span>{{ $item['labelDay'] }}</span>
                                    </div>
                                    <div class="check"></div>
                                    <div class="tile-body" style="overflow:initial;height: 100%;vertical-align: top;padding: 10px 10px;overflow: hidden;position: relative;font-weight: 400;font-size: 12px;color: #000000;color: #ffffff;margin-bottom: 10px;margin-bottom: 0 !important;">
                                        <i style="font-style:normal;margin-top: 17px;display: block;font-size: 56px;line-height: 56px;text-align: center;margin-left: -10px;">{{ $item['day'] }}</i>
                                    </div>
                                    <div class="tile-object" style="position: absolute;bottom: 0 !important;left: 0;right: 0;min-height: 30px;background-color: transparent;*zoom: 1;background: black !important;opacity: 0.8 !important;bottom: 7% !important;">
                                        <div class="name" style="position: absolute;bottom: 0;left: 0;margin-bottom: 5px;margin-left: 10px;margin-right: 15px;font-weight: 400;font-size: 13px;color: #ffffff;">{{ $item['month'] }}</div>
                                        <div class="number" style="position: absolute;bottom: 0;right: 0;margin-bottom: 0;color: #ffffff;text-align: center;font-weight: 600;font-size: 14px;letter-spacing: 0.01em;line-height: 14px;margin-bottom: 8px;margin-right: 10px;">{{ $item['year'] }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </center>
                </div>
            </div>
        </div>
    </section>
@endsection