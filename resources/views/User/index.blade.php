@extends('layouts.masterPanelAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-expert-ok">
                                <thead class="bg-eaf color-mashinchi th-p15">
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>شماره تماس</th>
                                    <th>تاریخ</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if (count($users) > 0)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{$user->name}} {{$user->family}}
                                            </td>
                                            <td>
                                                {{$user->phone_number}}
                                            </td>

                                            <td>
                                                {{$user->created_at}}
                                            </td>

                                            <td class="edite-td">
                                                <a href="{{ route('user.edit',$user->id) }}" class="icon-box edite-icon" data-toggle="tooltip"
                                                   data-original-title="ویرایش"></a>
                                                <a onclick="return confirm('آیا از حذف این کاربر اطمینان دارید؟');" href="{{ route('user.delete',$user->id) }}" class="icon-box delete-icon" data-toggle="tooltip"
                                                   data-original-title="حذف"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop