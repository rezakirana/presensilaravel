@extends('layouts/main-admin')

@section('title', 'Presensi')

@section('container')

<style>

.tabset > input[type="radio"] {
  position: absolute;
  left: -200vw;
}

.tabset .tab-panel {
  display: none;
}

.tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
.tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
.tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
.tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
.tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
.tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
  display: block;
}

.tabset > label {
  position: relative;
  display: inline-block;
  padding: 15px 15px 25px;
  border: 1px solid transparent;
  border-bottom: 0;
  cursor: pointer;
  font-weight: 600;
}

.tabset > label::after {
  content: "";
  position: absolute;
  left: 15px;
  bottom: 10px;
  width: 22px;
  height: 4px;
  background: #8d8d8d;
}

.tabset > label:hover,
.tabset > input:focus + label {
  color: #06c;
}

.tabset > label:hover::after,
.tabset > input:focus + label::after,
.tabset > input:checked + label::after {
  background: #06c;
}

.tabset > input:checked + label {
  border-color: #ccc;
  border-bottom: 1px solid #fff;
  margin-bottom: -1px;
}

.tab-panel {
  padding: 30px 0;
  border-top: 1px solid #ccc;
}

*,
*:before,
*:after {
  box-sizing: border-box;
}

.tabset {
  max-width: 65em;
}


.acc-kontainer {
  width: 100%;
  margin: auto;
}
.acc-kontainer .acc-body {
  width: 98%;
  width: calc(100% - 20px);
  margin: 0 auto;
  height: 0;
  color: rgba(0, 0, 0, 0);;
  background-color: rgba(255, 255, 255, 0.2);
  line-height: 28px;
  padding: 0 20px;
  box-sizing: border-box;
  transition: 0.5s;
}

.acc-kontainer label {
  cursor: pointer;
  background-color: #2783CF;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  display: block;
  padding: 15px;
  width: 100%;
  color: #fff;
  font-weight: 400;
  box-sizing: border-box;
  z-index: 100;
}

.acc-kontainer input{
  display: none;
}

.acc-kontainer label:before {
  font-family: 'FontAwesome';
  content: '\f067';
  font-weight: bolder;
  float: right;
}

.acc-kontainer input:checked+label {
  background-color: #03508F;
}

.acc-kontainer input:checked+label:before {
  font-family: 'FontAwesome';
  content: '\f00d';
  transition: 0.5s;
}

.acc-kontainer input:checked~.acc-body {
  height: auto;
  color: #8d8d8d;
  font-size: 16px;
  padding: 20px;
  transition: 0.5s;
}

.courses-container {

}

.course {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	display: flex;
	max-width: 100%;
	margin: 20px;
	overflow: hidden;
	width: 90%;
}

.course h6 {
	opacity: 0.6;
	margin: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
}

.course h2 {
	letter-spacing: 1px;
	margin: 10px 0;
}

.course-preview {
	background-color: #03508F;
	color: #fff;
	padding: 30px;
	max-width: 34%;
}

.course-preview a {
	color: #fff;
	display: inline-block;
	font-size: 12px;
	opacity: 0.6;
	margin-top: 30px;
	text-decoration: none;
}

.course-info {
	padding: 30px;
	position: relative;
	width: 100%;
}

.progress-container {
	position: absolute;
	top: 30px;
	right: 30px;
	text-align: right;
	width: 150px;
}

.progress {
	background-color: #ddd;
	border-radius: 3px;
	height: 5px;
	width: 100%;
}

.progress::after {
	border-radius: 3px;
	background-color: #FDB16B;
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	height: 5px;
	width: 100%;
}

.progress-text {
	font-size: 10px;
	opacity: 0.6;
	letter-spacing: 1px;
}

.btn_kursus {
	background-color: #FDB16B;
	border: 0;
	border-radius: 50px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	color: #fff;
	font-size: 16px;
	padding: 12px 25px;
	position: absolute;
	bottom: 30px;
	right: 30px;
	letter-spacing: 1px;
}

.informasi {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}



.informasi::after {
  content: "";
  clear: both;
  display: table;
}

.informasi img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.informasi img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
}


.movie {
    max-width: 800px;
    border-radius: 5px;
    display: flex;
    box-shadow: 0 5px 20px 10px rgba(0, 0, 0, .2);
   overflow: hidden;
}

.movie__hero {
  flex: 0 0 45%;
}

.movie__img {
    width: 100%;
    display: block;
}

.movie__content {
    background-color: #fff;
    flex: 1;
    padding: 35px 30px;
    display: flex;
    flex-direction: column;
}

.movie__price {
    background:linear-gradient(to bottom, #0350BF 0%, #E2BE52 100%);
    flex: 0 0 50px;
    font-size: 18px;
    font-weight: bold;
    letter-spacing: 2px;
    color: rgb(255, 255, 255);
    writing-mode: vertical-lr;
    display: flex;
    align-items: center;
    justify-content: center;
}

.movie__title {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.heading__primary {
    font-size: 16px;
    margin-right: auto;
    color: royalblue;
}

.fa-fire {
    color: salmon;
}

.movie__tag {
    font-size: 10px;
    color: #fff;
  padding: 2px 7px;
  border-radius: 100px;
  margin-right: 8px;
  display: block;
  text-transform: uppercase;

}

.movie__tag--1 {
  background-color: #0350BF;
}

.movie__description {
    font-size: 14px;
}

.movie__details {
    display: flex;
    margin: auto;
}

.movie__detail {
   font-size: 13px;
   margin-right: 20px;
   display: flex;
   align-items: flex-start;
}

.icons i {
    margin-right: 3px;
    font-size: 18px;
}

.icons-red {
    color: salmon;
}
.icons-grey {
    color: grey;
}

.icons-yellow {
    color: rgb(190, 190, 71);

}



.card-category-2 ul {
        padding: 0;
    }

    .card-category-2 ul li {
        list-style-type: none;
        display: inline-block;
        vertical-align: top;
    }

    .card-category-2 ul li {
        margin: 10px 5px;
    }

    .card-category-2 {
        font-family: sans-serif;
        margin-bottom: 45px;
        text-align: center;
    }

    .card-category-2 div {
        display: inline-block;
    }

    .card-category-1>div,
    .card-category-2>div:not(:last-child) {
        margin: 10px 5px;
        text-align: left;
    }
    /* Basic Card */

    .img-card {
        width: 300px;
        position: relative;
        border-radius: 5px;
        text-align: left;
        -webkit-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        -o-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
    }

    .img-card .card-image {
        position: relative;
        margin: auto;
        overflow: hidden;
        border-radius: 5px 5px 0px 0px;
        height: 200px;
    }

    .img-card .card-image img {
        width: 100%;
        border-radius: 5px 5px 0px 0px;
        -webkit-transition: all 0.8s;
        -moz-transition: all 0.8s;
        -o-transition: all 0.8s;
        transition: all 0.8s;
    }

    .img-card .card-image:hover img {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -o-transform: scale(1.1);
        transform: scale(1.1);
    }

    .img-card .card-text {
        padding: 0 15px 15px;
        line-height: 1.5;
    }

    .img-card.iCard-style1 .card-title {
        position: absolute;
        font-family: 'Open Sans', sans-serif;
        z-index: 1;
        top: 100px;
        left: 50px;
        right: 50px;
        font-size: 20px;
        color: #fff;
    }
    a {
      color: inherit; /* blue colors for links too */
      text-decoration: inherit; /* no underline */
    }


</style>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    <div class="card shadow mb-12">
        <!-- Card Body -->        
        <div class="card-body">
              <div class="tabset">     
                    <div class="card-category-2">
                        <ul>
                            @foreach ($data as $key => $item)
                                <li>
                                  <a href="{{ route('tambah.presensi',$item->id) }}">
                                    <div class="img-card iCard-style1" style="background-color: #f9f9f9;">
                                        <div class="card-content">
                                            <div class="card-image">
                                                @if ($item->icon)
                                                    <img src="{{ asset('/img/jadwal/'.$item->icon) }}" id="imgCurrent" width="100%" style="text-align: center;" />
                                                @else
                                                    <img src="{{ asset('/img/default-image.png') }}" id="imgCurrent" width="100%" style="text-align: center;" />
                                                @endif                                            
                                            </div>
                                            <div class="card-text">
                                            <h4 align="center"><b>{{ $item->kelas->nama_kelas }}</b></h4>
                                                <p align="justify" style="margin-bottom: 5px !important;">
                                                {{ $item->mapel->nama_mapel }}
                                                </p>
                                                <p align="justify" style="margin-bottom: 5px !important;">
                                                {{ $item->hari }}
                                                </p>
                                                <p align="justify" style="margin-bottom: 5px !important;">
                                                {{ $item->jam_pelajaran }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                  </a>
                                </li>
                            @endforeach                            
                        </ul>
                    </div>

                </div>

              </div>


        </div>
    </div>

@include ('includes.scripts')
@endsection
