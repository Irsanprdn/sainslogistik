<section id="services" class="services">
    <img src="{{ asset('assets') }}/compro/img/yellow-hexagonal.png" alt="circle-yellow" class="img-fluid position-absolute yellow-circle" style="top:-100px; right:-100px; z-index:200;width:35%;">

    <section id="icon-services" data-aos="fade-up">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">

                <div class="card shadow card-icon">
                    <div class="card-body py-0 px-md-5">
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-4 py-4-5 px-3">
                                <h1 class="font-weight-bold our-services-text">{!! $ourserviceTitle->isi_komponen ?? '' !!}</h1>
                                <p class="our-services-desc">{!! $ourserviceDescription->isi_komponen ?? ''  !!}</p>
                            </div>
                            @foreach( $dataService as $ds )
                            <div class="col-md col-4 py-4-5 px-0 our-services cursor-pointer text-center" data-bs-toggle="collapse" onclick="resetCollapse(this)" href="#collapse{{ str_replace(' ','',($ds->image_title ?? '')) }}" role="button" aria-controls="collapse{{ str_replace(' ', '',($ds->image_title ?? '')) }}">
                                <div class="border-start">
                                    <div class="icon">
                                        <img src="{{ asset('assets') }}/uploads/image/{{ $ds->image ?? '' }}" height="70" width="75" alt="Icon {{ $ds->image_title }}" data-type="storage">
                                        <p class="mb-0 mt-2 cursor-pointer our-services-desc text-center">{{ $ds->image_title }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-base card-icon-bot">
                        <div class="px-3">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach( $dataService as $ds )
                                    <div class="collapse collapseAll" id="collapse{{ str_replace(' ','',($ds->image_title ?? '')) }}">
                                        <div class="card card-body border-0 bg-base py-4">
                                            {!! $ds->image_description !!}
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="collapse collapseAll" id="collapseQuestion">
                                        <div class="card card-body border-0 bg-base py-4">
                                            <h5 class="font-weight-bold">Sharing Storage</h5>
                                            <p>Layanan berbagi tempat penyimpanan barang.</p>

                                            <h5 class="font-weight-bold">Sharing Storage</h5>
                                            <p>Layanan berbagi tempat penyimpanan barang.</p>
                                        </div>
                                    </div>
                                    <div class="collapse collapseAll" id="collapseDelivery">
                                        <div class="card card-body border-0 bg-base py-4">
                                            <h5 class="font-weight-bold">Sharing Storage</h5>
                                            <p>Layanan berbagi tempat penyimpanan barang.</p>

                                            <h5 class="font-weight-bold">Sharing Storage</h5>
                                            <p>Layanan berbagi tempat penyimpanan barang.</p>
                                        </div>
                                    </div>
                                    <div class="collapse collapseAll" id="collapseWarehouse">
                                        <div class="card card-body border-0 bg-base py-4">
                                            <h5 class="font-weight-bold">Sharing Storage</h5>
                                            <p>Layanan berbagi tempat penyimpanan barang.</p>

                                            <h5 class="font-weight-bold">Sharing Storage</h5>
                                            <p>Layanan berbagi tempat penyimpanan barang.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>