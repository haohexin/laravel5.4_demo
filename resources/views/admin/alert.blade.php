@if (session('error'))
    <div id="modal" class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('error') }}
    </div>
@elseif(session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!!  implode('<br>', $errors->all()) !!}
    </div>
@endif
<script>
    setTimeout(function(){$("#modal").modal("hide")},2000);
</script>
