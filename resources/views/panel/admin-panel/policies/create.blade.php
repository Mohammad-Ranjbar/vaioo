@extends('panel.layout.layout')
@section('title')
    ایجاد سیاست ارسال
@endsection
@section('breadcrumb')
    ایجاد سیاست ارسال
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ایجاد سیاست ارسال
                    </h5>
                    <hr>

                    <form action="{{route('admin.policies.create')}}" method="post" role="form">
                        @csrf
                        <div class="mb-3">

                            <label for="is_active" class="form-label">کشور</label>
                            <select class="form-select" id="is_active" name="is_active">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->title}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="policy">
                                توضیحات
                            </label>
                            <textarea dir="rtl" id="policy" name="policy" class="form-control text-right" rows="10"></textarea>
                        </div>

                        <div class="mb-3">

                            <label for="is_active" class="form-label">وضعیت</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1"> فعال</option>
                                <option value="0">غیرفعال</option>
                            </select>
                        </div>
                        <button class="btn btn-success">
                            ثبت
                        </button>
                    </form>


                </div>
            </div>

        </div>
    </div>
@endsection
