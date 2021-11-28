
@extends('master')
@section('content')
    <section class="Feautes section" style="background-color: white; background-image: linear-gradient(white, #99ffbb);"><hr class="line1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Silakan Pilih Poli untuk mendaftar</h3>
                    <br/><br/> 
                    <div id="content" class="col-md-12 tiles" style="margin-bottom:120px;padding-right: 5px;padding-left: 5px;margin-right: 0 !important;border-radius: 0 !important;">
                        @foreach ($poli as $key => $item)
                            <div class="col-md-3 col-xs-6" style="padding-right: 5px;padding-left: 5px;float: left;position: relative;min-height: 1px;">
                                <div class="tile tilebig3 image bg-green-turquoise" style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 14px;color: #888;cursor: default!important;height: 200px;width: 100% !important;margin: 0 0 10px 0;display: block;float: left;cursor: pointer;text-decoration: none;position: relative;font-weight: 300;font-size: 12px;letter-spacing: 0.02em;line-height: 20px;overflow: hidden;border: 4px solid transparent;border-color: #36d7b7 !important;background-image: none !important;background-color: #36d7b7 !important;color: white !important;">
                                    <div class="corner" style="border-radius: 0 !important;box-sizing: border-box;cursor: pointer;font-weight: 300;font-size: 12px;letter-spacing: 0.02em;line-height: 20px;color: white !important;"></div>
                                    <div class="check" style="text-align:right;color:black;font-weight:bold;font-size:20px;border-radius: 0 !important;box-sizing: border-box;cursor: pointer;letter-spacing: 0.02em;line-height: 20px;">
                                        <div class="number" style="border-radius: 0 !important;box-sizing: border-box;text-align: right;color: black;font-weight: bold;font-size: 20px;cursor: pointer;letter-spacing: 0.02em;line-height: 20px;">{{ $item->jmlAntrian }}</div>
                                    </div>
                                    <div class="tile-body" style="margin-top:-30px" style="padding: 0 !important;height: 100%;vertical-align: top;overflow: hidden;position: relative;font-weight: 400;font-size: 12px;color: #ffffff;">
                                        <a href="{{ route('pendaftaran.detail',$item->id) }}">
                                            <i style="margin-top: 17px;display: block;font-size: 56px;line-height: 56px;text-align: center;">
                                                @if($item->gambar)
                                                    <img src="{{ asset('/img/poli/'.$item->gambar) }}" style="float:none;max-width:135px;margin-right: 10px;">
                                                @else
                                                    <img src="https://ehealth.surabaya.go.id/pendaftaran/files/imgehealth/klinik umum.png" style="float:none;max-width:135px;margin-right: 10px;">
                                                @endif
                                            </i>
                                        </a>
                                    </div>
                                    <div class="tile-object" style="background:black;opacity:0.6;bottom:0 !important;position: absolute;left: 0;right: 0;min-height: 30px;background: black !important;opacity: 0.8 !important;">
                                        <div class="name" style="position:relative;padding-top:5px;font-size:17px;bottom: 0;left: 0;margin-bottom: 5px;margin-left: 10px;margin-right: 15px;font-weight: 400;font-size: 13px;color: #ffffff;">
                                            <a href="{{ route('pendaftaran.detail',$item->id) }}">
                                                {{ $item->nama }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                        @endforeach                            
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection