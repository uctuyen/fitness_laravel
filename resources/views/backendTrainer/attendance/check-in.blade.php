@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['check-in']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('trainer.attendance.post-check-in', $calendar->id) }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row bg-info">
            @foreach ($attendances as $item)
            <div class="col-lg-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" 
                            name="attendance_id[{{ $item->id }}]"
                            {{ $item->status == 1 ? 'checked' : '' }}
                        > 
                        {{ $item->member->first_name . ' ' . $item->member->last_name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send"> <i class="fa fa-save mr1"> Lưu
                </i> </button>
        </div>
    </div>
</form>
