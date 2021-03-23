<style>
    span.danger-color {
        color: red;
    }
    span.del-color {
        color: #ff6c00;
        text-decoration: line-through;
    }
</style>
@if ($sale->status == 1)
    <span class="success-color">
        تایید شده
    </span>
@elseif($sale->status == 2)
    <span class="del-color">
        حذف شده
    </span>
@elseif($sale->status == 3)
    <span class="danger-color">
        فروخته شده
    </span>
@elseif($sale->status == 4)
    <span style="color:#ef8519">
        در انتظار تایید
    </span>
@elseif($sale->status == 0)
    <span class="failed-color">
        تایید نشده
    </span>
@endif