@extends('panel.layout.layout')
@section('title')
    ویرایش سیاست ارسال::
    {{$policy->country->name_fa}}
@endsection
@section('breadcrumb')
    ویرایش سیاست ارسال::
    {{$policy->country->name_fa}}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        توضیحات سیاست مربوط به کشور :: {{$policy->country->name_fa}}
                    </h5>
                    <hr>

                    <form action="{{route('admin.policies.update',$policy->id)}}" method="post" role="form">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="policy">
                                توضیحات
                            </label>
                            <textarea dir="rtl" id="policy" name="policy" class="form-control text-right" rows="10">{{$policy->policy}}</textarea>
                        </div>

                        <div class="mb-3">

                            <label for="is_active" class="form-label">وضعیت</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option {{$policy->is_active ? 'selected' : ''}} value="1"> فعال</option>
                                <option {{!$policy->is_active ? 'selected' : ''}} value="0">غیرفعال</option>
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
