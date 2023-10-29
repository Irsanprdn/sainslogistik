@extends('admin')
@section('title', 'About')
@section('content')
<div class="container">
    @if (session('error'))
    <div class="alert my-3 alert-danger">{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('success'))
    <div class="alert my-3 alert-success">{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="id-tab" data-bs-toggle="tab" data-bs-target="#id" type="button" role="tab" aria-controls="id" aria-selected="true">Indonesia</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">English</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="id" role="tabpanel" aria-labelledby="id-tab">
            <section id="about" class="about">
                <div class="container position-realtive" style="z-index: 300;">

                    <div class="section-title">
                        <div class="d-flex justify-content-start">
                            <h1 class="text-dark font-weight-bold title-question">
                                <input type="text" data-lang="id" id="aboutTitle" name="aboutTitle" value="{{ $aboutTitle->isi_komponen ?? '' }}" class="form-custom form-custom-lg text-dark font-weight-bold title-question reset-setting" readonly>
                            </h1>
                            <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#aboutTitle')" title="Clik to edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-10">
                                <textarea id="mytextarea">
                                {{ $aboutDescription->isi_komponen ?? '' }}
                                </textarea>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary text-light mt-4" onclick="saveTextArea(this)" data-lang="id" title="Clik to Save">
                                    <i class="bi bi-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
            <section id="about" class="about">
                <div class="container position-realtive" style="z-index: 300;">

                    <div class="section-title">
                        <div class="d-flex justify-content-start">
                            <h1 class="text-dark font-weight-bold title-question">
                                <input type="text" data-lang="en" id="aboutTitleen" name="aboutTitle" value="{{ $aboutTitleEN->isi_komponen ?? '' }}" class="form-custom form-custom-lg text-dark font-weight-bold title-question reset-setting" readonly>
                            </h1>
                            <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#aboutTitleen')" title="Clik to edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-10">
                                <textarea id="mytextareaen">
                                {{ $aboutDescriptionEN->isi_komponen ?? '' }}
                                </textarea>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary text-light mt-4" onclick="saveTextArea(this)" data-lang="en" title="Clik to Save">
                                    <i class="bi bi-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @endsection

    @section('js')
    <script>
        tinymce.init({
            selector: '#mytextarea',
            promotion: false,
            menubar: false,
            // plugins: [
            //     'save'
            // ],
            toolbar: ' undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: "Open Sans", sans-serif;font-size: 20px;font-weight: 400;line-height: 36px;letter-spacing: 0em;text-align: justified;}',

        });

        tinymce.init({
            selector: '#mytextareaen',
            promotion: false,
            menubar: false,
            // plugins: [
            //     'save'
            // ],
            toolbar: ' undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: "Open Sans", sans-serif;font-size: 20px;font-weight: 400;line-height: 36px;letter-spacing: 0em;text-align: justified;}',

        });

        function saveTextArea(e) {
            var lang = $(e).attr('data-lang')
            var text = "";
            if ( lang == 'id' ) {
                text = tinymce.get("mytextarea").getContent();                
            }else{
                text = tinymce.get("mytextareaen").getContent();                
            }

            var komponen = 'description';
            var data = {
                _token: '{{ csrf_token() }}',
                menu: 'about',
                komponen: komponen,
                language: lang,
                text: text
            }

            var urle = "{{  route('home.post') }}";
            var datae = JSON.stringify(data);
            postData(urle, datae)
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
                komponen = (e == '#aboutTitle' ? 'title' : 'description')            
            }else{
                komponen = (e == '#aboutTitleen' ? 'title' : 'description')
            }
            var data = {
                _token: '{{ csrf_token() }}',
                menu: 'about',
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

        function openFormFile() {
            $('#imgFile').click();
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


        new DataTable('#slideTable', {
            fixedHeader: true,
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300,
            bLengthChange: true,
            bInfo: false,
            "initComplete": function(settings, json) {
                $('#slideTable_wrapper').children().children().first().append($('#btn-add').html())
                $('#slideTable_wrapper').find('#btn-add').removeClass('d-none')
                $('#slideTable_wrapper').children().children().children().attr('id', 'btn-tambah')
            }
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

        function getDataEdit(e, clientId) {

            var clientName = $(e).parent().parent().find('.clientName').text()
            var clientLogo = $(e).parent().parent().find('.clientLogo').children().attr('src');
            var clientStatus = $(e).parent().parent().find('.clientStatus').text();
            if ($('#collapseTambahData').hasClass('show')) {
                resetForm();
                $('#btn-tambah').click()
            } else {
                $('#grup').attr('readonly', true)
                $('#btn-tambah').click()

                $('#client_id').val(clientId)
                $('#client_name').val(clientName)
                $('#viewImg').attr('src', clientLogo)
                $('#status').val(clientStatus)
            }
        }

        function resetForm() {
            $('#formPost')[0].reset()
        }
    </script>
    @endsection