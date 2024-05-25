<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>LỊCH TẬP TẠI TRUNG TÂM VENUS</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="row">
                                <div class="col-lg-1">
                                    <label for="" class="control-label text-Left">Chọn lớp:</label>
                                </div>
                                <div class="col-lg-3">
                                    <select name="class_id" class="form-control">
                                        <option value="">Chọn lớp học</option>
                                        @foreach ($classes as $item)
                                        <option {{ request()->class_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                </div>
                            </form>

                            <table class="table table-striped table-bordered" style="margin-top: 30px;">
                                <thead>
                                    <tr>
                                        <th>Ca</th>
                                        <th>Thứ 2</th>
                                        <th>Thứ 3</th>
                                        <th>Thứ 4</th>
                                        <th>Thứ 5</th>
                                        <th>Thứ 6</th>
                                        <th>Thứ 7</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calendars as $item)
                                    <tr>
                                        <td>{{ $item->duration }}</td>
                                        <td>{{ formatDate($item->start_date, 'l') == "Monday" ? $item->class->trainer->fullname : '' }}</td>
                                        <td>{{ formatDate($item->start_date, 'l') == "Tuesday" ? $item->class->trainer->fullname : '' }}</td>
                                        <td>{{ formatDate($item->start_date, 'l') == "Wednesday" ? $item->class->trainer->fullname : '' }}</td>
                                        <td>{{ formatDate($item->start_date, 'l') == "Thursday" ? $item->class->trainer->fullname : '' }}</td>
                                        <td>{{ formatDate($item->start_date, 'l') == "Friday" ? $item->class->trainer->fullname : '' }}</td>
                                        <td>{{ formatDate($item->start_date, 'l') == "Saturday" ? $item->class->trainer->fullname : '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
