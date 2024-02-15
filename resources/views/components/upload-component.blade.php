<!-- resources/views/components/upload-component.blade.php -->
<div class="col-12">
    <div class="row my-3">
        <div class="col-3 doc_title_no_wrap">{{ $label }}
        </div>
        <div class="col-9 ">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="{{ $id }}" name="docs[]"
                    onchange="displayFileName(this)">
                <label class="custom-file-label" for="{{ $id }}">Choose file</label>
            </div>
        </div>
    </div>
</div>

