{/* <script> */ }
$(document).ready(function () {
    $("#pname").change(function () {
        let pname = $("#pname").val();
        $("#pslug").val(pname.toLowerCase().replace(/ /g, "-"));
    });
});
// </script>

// <script>
$(document).ready(function () {

    var IMAGE_PATH = 'http://localhost/techverse/images/blogs/';

    $('.summernote').summernote({
        height: 300,
        callbacks: {
            onImageUpload: function (image) {
                uploadImage(image[0]);
            }
        }
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            data: data,
            type: "POST",
            url: "uploader.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
                var image = IMAGE_PATH + url;
                $('#summernote').summernote('insertImage', image);
                console.log(image);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

});
// </script>
// <script>
$(function () {
    bsCustomFileInput.init();
});
// </script>
// <script>
// @if (!empty($arrAttr[0]))
//     let loop_count = {{ count($productAttrArr) }};
// @else
//     let loop_count = 1;
// @endif

function add_more() {
    loop_count++;
    var html = `<div class='card' id='product_attr_${loop_count}'><div class='card-body'><div class='row'>`;
    html +=
        `<div class="col-lg-6 col-md-6 col-12">
                    <input type="text" class="form-control" id="exampleInputCategory"
                        value=""
                        name="paid[]" hidden>
                    <div class="form-group">
                        <label for="exampleInputCategory">MRP</label>
                        <input type="text" class="form-control" id="exampleInputCategory"value="@if (isset($data)) {{ $data[0]->mrp }} @endif"name="mrp[]" placeholder="Enter MRP">
                        <p class="text-danger"></p>
                    </div >
                </div>`;
    html +=
        `<div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleInputCategory">Price</label>
                        <input type="text" class="form-control" id="exampleInputCategory" value="@if (isset($data)) {{ $data[0]->price }} @endif" name="price[]" placeholder="Enter price">
                    </div >
                </div>`

    html += `
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleInputCategory">Quantity</label>
                        <input type="text" class="form-control" id="exampleInputCategory"
                            value="@if (isset($data)) {{ $data[0]->quantity }} @endif"
                            name="quantity[]" placeholder="Enter quantity">
                    </div>
                </div>`;

    html += `
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleInputCategory">SKU</label>
                        <input type="text" class="form-control" id="exampleInputCategory"
                            value="@if (isset($data)) {{ $data[0]->sku }} @endif"
                            name="sku[]" placeholder="Enter sku">
                    </div>
                </div>`;

    html += `
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Size</label>
                        <select class="custom-select rounded-0" name="size[]"
                            id="exampleSelectRounded0">
                            <option value="0">Select Size</option>
                            @foreach ($size as $list)
                                @if (isset($data) && $data[0]->cid == $list->id)
                                    <option selected value="{{ $list->id }}">
                                        {{ $list->size }}
                                    </option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->size }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Color</label>
                        <select class="custom-select rounded-0" name="color[]"
                            id="exampleSelectRounded0">
                            <option value="0">Select Color</option>
                            @foreach ($color as $list)
                                @if (isset($data) && $data[0]->cid == $list->id)
                                    <option selected value="{{ $list->id }}">
                                        {{ $list->color }}
                                    </option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->color }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="attrimg[]"
                                    id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose
                                    Image</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <button class="btn btn-danger" type="button" onclick="remove_attr(${loop_count})">Remove</button>
                </div>
                `;

    html += "</div></div></div>";
    $('#product_attr').append(html);
    bsCustomFileInput.init();
}

function remove_attr(loop_count) {
    $('#product_attr_' + loop_count).remove()
}



function add_more_img() {
    img_loop++;
    var html = `
                        <div class="row" id="product_img_${img_loop}">
                `;
    html += `
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" class="form-control" id="exampleInputCategory" value="" name="piid[]" hidden>
                                <input type="file" class="custom-file-input" name="productimg[]"
                                    id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose
                                    Image</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <img src="" alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <button class="btn btn-danger" type="button" onclick="remove_more_img(${img_loop})">Delete</button>
                </div>
                `;
    html += `
                </div>
            `;
    $('#product_images').append(html);
    bsCustomFileInput.init();
}

function remove_more_img(img_loop) {
    $('#product_img_' + img_loop).remove()
}
{/* </script> */ }
