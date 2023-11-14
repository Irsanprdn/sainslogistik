 @extends('admin')
 @section('title', 'About Image')
 @section('content')
 <div class="collapse" id="collapseTambahData">
     <div class="card card-body">
         <form action="{{ route('image.post') }}" enctype="multipart/form-data" method="POST" id="formPost">
             @csrf
             <div class="row">
                 <div class="col-md-2 col-12">
                     <div class="form-group">
                         <label for="language">Language</label>
                         <select name="language" id="language" class="form-control">
                             <option value="">Choose Language</option>
                             <option value="EN">English</option>
                             <option value="ID">Indonesia</option>
                         </select>
                     </div>
                 </div>
                 <div class="col-md-8 col-12">
                     <div class="form-group">
                         <label for="image_title">Image Title</label>
                         <input type="text" name="image_id" class="form-control d-none" id="image_id">
                         <input type="text" name="menu" value="image" class="form-control d-none" id="menu">
                         <input type="text" name="image_title" class="form-control" id="image_title">
                     </div>
                 </div>
                 <div class="col-md-2 col-12">
                     <div class="form-group">
                         <label for="status">Status</label>
                         <select name="status" id="status" class="form-control">
                             <option value="">Choose Status</option>
                             <option value="Draft">Draft</option>
                             <option value="Publish">Publish</option>
                         </select>
                     </div>
                 </div>
                 <div class="col-md-12 col-12">
                     <div class="form-group">
                         <label for="image_description">Image Description</label>
                         <textarea id="mytextarea" name="image_description">
                        </textarea>
                     </div>
                 </div>
                 <div class="col-md-6 col-12">
                     <div class="form-group">
                         <label for="image">Image <span style="font-size: 13px;">* File input must be format jpg,jpeg,png Max Size( 2 mb )</span></label>
                         <input type="file" class="form-control" name="imgFile" id="imgFile" onchange="readURL(this)">
                     </div>
                 </div>
                 <div class="col-md-6 col-12">
                     <div id="preview" class="text-center">
                         <img id="viewImg" alt="Upload Preview" style="width: 115px;height:115px;">
                     </div>
                 </div>
                 <div class="col-md-12">
                     <p class="text-right mt-3 pb-0 mb-0">
                         <button class="btn btn-sm btn-secondary" type="button" onclick="resetForm()"><i class="bi bi-arrow-clockwise"></i> Reset Form</button>
                         <button class="btn btn-sm btn-success" type="submit"><i class="bi bi-save"></i> Simpan Data</button>
                     </p>
                 </div>
             </div>
         </form>
     </div>
 </div>
 @if (session('error'))
 <div class="alert my-3 alert-danger">{{ session('error') }}</div>
 @endif
 @if (session('success'))
 <div class="alert my-3 alert-success">{{ session('success') }}</div>
 @endif
 <ul class="nav nav-tabs" id="myTab" role="tablist">
     <li class="nav-item" role="presentation">
         <button class="nav-link active" id="id-tab" data-bs-toggle="tab" data-bs-target="#id" type="button" role="tab" aria-controls="id" aria-selected="true">Indonesia</button>
     </li>
     <li class="nav-item" role="presentation">
         <button class="nav-link" id="en-tab" onclick="getWidth()" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">English</button>
     </li>
 </ul>
 <div class="tab-content" id="myTabContent">
     <div class="tab-pane fade show active" id="id" role="tabpanel" aria-labelledby="id-tab">
         <div class="d-flex justify-content-start my-3">
             <h1 class="text-dark font-weight-bold title-question">
                 <input type="text" data-lang="id" id="aboutimageTitle" name="aboutimageTitle" value="{{ $aboutimageTitle->isi_komponen ?? '' }}" class="form-custom form-custom-lg text-dark font-weight-bold title-question reset-setting" readonly>
             </h1>
             <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#aboutimageTitle')" title="Clik to edit">
                 <i class="bi bi-pencil"></i>
             </button>
         </div>

         <div class="table-responsive">
             <table id="image-data-id" class="table table-striped table-hover" width="100%">
                 <thead class="bg-base text-light">
                     <tr>
                         <th>Order</th>
                         <th>Image Title</th>
                         <th>Image Description</th>
                         <th>Image</th>
                         <th>Status</th>
                         <th>Language</th>
                         <th>Updated By</th>
                         <th>Updated Date</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     @php
                     $no_id = 1;
                     @endphp
                     @foreach( $dataId as $d )
                     <tr>
                         <td class="idx text-center cursor-grab" data-id="{{ $d->image_id }}">{{ $no_id++ }}</td>
                         <td class="imageTitle">{{ $d->image_title ?? ''}}</td>
                         <td class="imageDescription">{!! $d->image_description ?? '' !!}</td>
                         <td class="image">
                             <img src="{{ asset('assets') }}/uploads/image/{{ $d->image ?? ''}}" alt="{{ $d->image_title ?? ''}}" width="100">
                         </td>
                         <td class="imageStatus">{{ $d->status ?? ''}}</td>
                         <td class="language">{{ $d->language ?? ''}}</td>
                         <td class="updatedBy">{{ $d->updated_by ?? ''}}</td>
                         <td class="updatedDate">{{ $d->updated_date ?? '' }}</td>
                         <td>
                             <button onclick="getDataEdit(this, '{{ $d->image_id }}', '{{ $d->menu }}')" type="button" class="btn btn-sm btn-warning mx-1" title="Ubah"><i class="bi bi-pencil"></i> </button>
                             <a data-url="{{ route('image.delete',[$d->image_id, 'image']) }}" onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
     <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
         <div class="d-flex justify-content-start my-3">
             <h1 class="text-dark font-weight-bold title-question">
                 <input type="text" data-lang="en" id="aboutimageTitleen" name="aboutimageTitle" value="{{ $aboutimageTitleEN->isi_komponen ?? '' }}" class="form-custom form-custom-lg text-dark font-weight-bold title-question reset-setting" readonly>
             </h1>
             <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#aboutimageTitleen')" title="Clik to edit">
                 <i class="bi bi-pencil"></i>
             </button>
         </div>
         <div class="table-responsive">
             <table id="image-data-en" class="table table-striped table-hover" width="100%">
                 <thead class="bg-base text-light">
                     <tr>
                         <th>Order</th>
                         <th>Image Title</th>
                         <th>Image Description</th>
                         <th>Image</th>
                         <th>Status</th>
                         <th>Language</th>
                         <th>Updated By</th>
                         <th>Updated Date</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     @php
                     $no_en = 1;
                     @endphp
                     @foreach( $dataEn as $d )
                     <tr>
                         <td class="idx text-center cursor-grab" data-id="{{ $d->image_id }}">{{ $no_en++ }}</td>
                         <td class="imageTitle">{{ $d->image_title ?? ''}}</td>
                         <td class="imageDescription">{!! $d->image_description ?? '' !!}</td>
                         <td class="image">
                             <img src="{{ asset('assets') }}/uploads/image/{{ $d->image ?? ''}}" alt="{{ $d->image_title ?? ''}}" width="100">
                         </td>
                         <td class="imageStatus">{{ $d->status ?? ''}}</td>
                         <td class="language">{{ $d->language ?? ''}}</td>
                         <td class="updatedBy">{{ $d->updated_by ?? ''}}</td>
                         <td class="updatedDate">{{ $d->updated_date ?? '' }}</td>
                         <td>
                             <button onclick="getDataEdit(this, '{{ $d->image_id }}', '{{ $d->menu }}')" type="button" class="btn btn-sm btn-warning mx-1" title="Ubah"><i class="bi bi-pencil"></i> </button>
                             <a data-url="{{ route('image.delete',[$d->image_id, 'image']) }}" onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <div id="btn-add" class="d-none">
     <button class="btn btn-sm btn-primary bg-base btn-adds" data-toggle="collapse" href="#collapseTambahData" role="button" aria-expanded="false" aria-controls="collapseTambahData" type="button"><i class="bi bi-plus"></i> Tambah Data</button>
 </div>
 @endsection
 @section('js')
 <script>
     var dataTableId = new DataTable('#image-data-id', {
         fixedHeader: true,
         paging: false,
         scrollCollapse: true,
         scrollX: true,
         scrollY: 350,
         autoWidth: true,
         rowReorder: true,
         bLengthChange: true,
         bInfo: false,
         "initComplete": function(settings, json) {
             $('#image-data-id_wrapper').children().children().first().append($('#btn-add').html())
             $('#image-data-id_wrapper').find('#btn-add').removeClass('d-none')
             $('#image-data-id_wrapper').children().children().children().attr('id', 'btn-tambah')
         }
     });

     document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((el) => {
         el.addEventListener('shown.bs.tab', () => {
             dataTableId.tables({
                 visible: true,
                 api: true
             }).columns.adjust();
         });
     });

     var dataTableEn = new DataTable('#image-data-en', {
         fixedHeader: true,
         paging: false,
         scrollCollapse: true,
         scrollX: true,
         scrollY: 350,
         autoWidth: true,
         rowReorder: true,
         bLengthChange: true,
         bInfo: false,
         "initComplete": function(settings, json) {
             $('#image-data-en_wrapper').children().children().first().append($('#btn-add').html())
             $('#image-data-en_wrapper').find('#btn-add').removeClass('d-none')
             $('#image-data-en_wrapper').children().children().children().attr('id', 'btn-tambah')
         }
     });

     document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((el) => {
         el.addEventListener('shown.bs.tab', () => {
             dataTableId.tables({
                 visible: true,
                 api: true
             }).columns.adjust();
         });
     });

     dataTableId.on('order.dt', function() {
         // Your custom logic after reordering rows goes here     
         var rowOrderArray = [];
         $('#image-data-id tbody tr').each(function() {
             var rowOrder = $(this).find('.idx')
             var rowOrderId = rowOrder.attr('data-id')
             var rowOrderIdx = rowOrder.text()
             rowOrderArray.push(rowOrderId + '-' + rowOrderIdx)
         })
         console.log(rowOrderArray)

         var data = {
             _token: '{{ csrf_token() }}',
             roworder: rowOrderArray,
             lang: 'ID',
             menu: 'image',
         }

         var urle = "{{  route('image.order') }}";
         var datae = JSON.stringify(data);
         $.ajax({
             type: 'POST',
             url: urle,
             contentType: "application/json",
             processData: false,
             data: datae,
             success: function(response) {
                 // console.log(response)
                 // if (response.code == 200) {
                 //     alert('Successfully')
                 // } else {
                 //     alert('Failed')
                 // }
             }
         });
     });

     dataTableEn.on('order.dt', function() {
         // Your custom logic after reordering rows goes here     
         var rowOrderArray = [];
         $('#image-data-en tbody tr').each(function() {
             var rowOrder = $(this).find('.idx')
             var rowOrderId = rowOrder.attr('data-id')
             var rowOrderIdx = rowOrder.text()
             rowOrderArray.push(rowOrderId + '-' + rowOrderIdx)
         })
         console.log(rowOrderArray)

         var data = {
             _token: '{{ csrf_token() }}',
             roworder: rowOrderArray,
             lang: 'EN',
             menu: 'image',
         }

         var urle = "{{  route('image.order') }}";
         var datae = JSON.stringify(data);
         $.ajax({
             type: 'POST',
             url: urle,
             contentType: "application/json",
             processData: false,
             data: datae,
             success: function(response) {
                 // console.log(response)
                 // if (response.code == 200) {
                 //     alert('Successfully')
                 // } else {
                 //     alert('Failed')
                 // }
             }
         });
     });

     function getWidth() {
         //  alert($('#image-data-id').parent().attr('style'))
         //  alert($('#image-data-en').parent().attr('style'))
     }

     tinymce.init({
         selector: '#mytextarea',
         promotion: false,
         menubar: false,
         toolbar: ' undo redo | formatselect | ' +
             'bold italic backcolor | alignleft aligncenter ' +
             'alignright alignjustify | bullist numlist outdent indent | ' +
             'removeformat | help',
         content_style: 'body { font-family: "Open Sans", sans-serif;font-size: 16px;}',
     });

     function confirmDelete(e) {
         if (confirm('Are you sure ?')) {
             var url = $(e).attr('data-url')
             window.location.href = url;
         } else {
             // Do nothing!
             Alert('Hapus telah dibatalkan')
         }
     }

     function getDataEdit(e, imageId, menu) {

         var imageTitle = $(e).parent().parent().find('.imageTitle').text()
         var imageDescription = $(e).parent().parent().find('.imageDescription').text()
         var image = $(e).parent().parent().find('.image').children().attr('src');
         var imageStatus = $(e).parent().parent().find('.imageStatus').text();
         var language = $(e).parent().parent().find('.language').text();
         if ($('#collapseTambahData').hasClass('show')) {
             resetForm();
             $('#btn-tambah').click()
         } else {
             $('#grup').attr('readonly', true)
             $('#btn-tambah').click()
             $("#collapseTambahData").scrollTop();

             $('#image_id').val(imageId)
             tinymce.get("mytextarea").setContent(imageDescription);
             $('#menu').val(menu)
             $('#language').val(language)
             $('#image_title').val(imageTitle)
             $('#viewImg').attr('src', image)
             $('#status').val(imageStatus)
         }
     }

     function resetForm() {
         $('#formPost')[0].reset()
     }

     function readURL(input) {
         var defaults = "";
         if (input.files && input.files[0]) {
             var reader = new FileReader();

             reader.onload = function(e) {
                 $('#viewImg')
                     .attr('src', e.target.result);
             };

             reader.readAsDataURL(input.files[0]);
         } else {
             $('#viewImg').attr('src', defaults);
         }
     }

     function editText(btn, e) {
            if ($(btn).hasClass('btn-warning')) {
                $('.btn-circle').find('.bi').removeClass('bi-save')
                $('.btn-circle').find('.bi').addClass('bi-pencil')

                $('.btn-circle').removeClass('btn-primary')
                $('.btn-circle').addClass('btn-warning')

                $('.btn-circle').attr('title', 'Click to edit')

                $(btn).find('.bi').removeClass('bi-pencil')
                $(btn).find('.bi').addClass('bi-save')

                $(btn).removeClass('btn-warning')
                $(btn).addClass('btn-primary')
                $(btn).attr('title', 'Click to save')

                $(e).focus()
                $(e).attr('readonly', false);
            } else {
                $('.btn-circle').find('.bi').removeClass('bi-save')
                $('.btn-circle').find('.bi').addClass('bi-pencil')

                $('.btn-circle').removeClass('btn-primary')
                $('.btn-circle').addClass('btn-warning')

                $(btn).find('.bi').removeClass('bi-save')
                $(btn).find('.bi').addClass('bi-pencil')

                $(btn).removeClass('btn-primary')
                $(btn).addClass('btn-warning')

                $('.reset-setting').attr('readonly', true);

                saveText(e)
            }
        }

        function saveText(e) {
            var text = $(e).val()
            var lang = $(e).attr('data-lang')
            var komponen = "";
            if ( lang == 'id' ) {
                komponen = (e == '#aboutimageTitle' ? 'title' : 'description')            
            }else{
                komponen = (e == '#aboutimageTitleen' ? 'title' : 'description')
            }
            var data = {
                _token: '{{ csrf_token() }}',
                menu: 'aboutimage',
                komponen: komponen,
                language: lang,
                text: text
            }

            var urle = "{{  route('home.post') }}";
            var datae = JSON.stringify(data);
            postData(urle, datae)

        }

        function postData(urle, datae) {
            $.ajax({
                type: 'POST',
                url: urle,
                contentType: "application/json",
                processData: false,
                data: datae,
                success: function(response) {
                    // console.log(response)
                    if (response.code == 200) {
                        alert('Successfully')
                    } else {
                        alert('Failed')
                    }
                }
            });
        }
 </script>
 @endsection