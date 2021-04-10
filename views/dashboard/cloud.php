
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Multiple Authorization</h2>
            <form action="trackupload" enctype="multipart/form-data" class="dropzone" id="image-upload">
                <div>

                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize:1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>




