@extends('layouts.main')
@php
    $lang=App::getLocale();
    $name='name_'.$lang;
@endphp
@push('styles')
    <style>
        .section__body-419{
            padding: 60px 0 150px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }
        .text-content{

            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .text-content h2{
            font-size: 60px;
            line-height: 100%;
            color: #333333;
            font-weight: 900;
        }
        .text-content h4{
            font-size: 38px;
            line-height: 100%;
            font-weight: 600;
            color: #333333;
        }
        text-content p{
            font-size: 18px;
            line-height: 100%;
            font-weight: 400;
            color: #333333;
        }

        .first-btn{
            font-size: 17px;
            font-style: normal;
            font-weight: bold;
            border-radius: 4px;
            border: 0;
            padding: 15px 64px;
            margin: 0 10px 0 0;
            background: #8E2976 ;
            color: #FFFFFF;
        }

        .second-btn{
            font-size: 17px;
            font-style: normal;
            font-weight: bold;
            border-radius: 4px;
            border: 0;
            padding: 15px 64px;
            margin: 0 10px 0 0;
            background: rgba(142, 41, 118, 0.16) ;
            color: #8E2976;
        }

        .img-content{
            width: 60%;
        }

        .img-content img{
            max-width: 481px;
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        @media screen and (max-width: 1200px) {
            .section__body-419{
                flex-direction: column;
            }

            .text-content h4 {
                text-align: center;
            }

            .text-content{
                width: 100%;
                display: flex;
                gap: 10px;
                flex-direction: column;
                align-items: center;
            }

            .btn-block{
                display: flex !important;
                justify-content: center;
                gap: 20px;
            }

            .img-content{
                display: flex;
                justify-content: center;
                width: 100%;
            }

            @media screen and (max-width: 600px){
                .btn-block{
                    display: flex;
                    flex-direction: column;
                }

                .img-content img {
                    width: 100%;

                }
            }
        }
    </style>

    @section('title','')
@section('content')
    <div class="page_419">
        <div class="container">
            <div class="section__body-419">
                <div class="section__body-block text-content">
                    <h2>419</h2>
                    <h4>Извините, срок действия вашего сеанса истек </h4>
                    <p>Вернитесь на главную или обновите страницу</p>
                    <div class="btn-block">
                        <button class="first-btn">На главную</button>
                        <button class="second-btn">Обновить страницу</button>
                    </div>
                </div>
                <div class="section__body-block img-content">
                    <img src="/images/errors/419.png">
                </div>
            </div>
        </div>
    </div>
@endsection

