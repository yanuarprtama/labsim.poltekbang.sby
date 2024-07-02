<div class="content my-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: white">
                        <h3>{{ $title }}</h3>

                        @if (isset($isInsert))
                            @if ($isInsert)
                                <a class="btn btn-success mb-3" href="{{ $url }}">Tambah</a>
                            @endif
                        @endif

                        <div class="overflow-visible" style="width: 10wv">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show " role="alert">
                                    {{ session('success') }}!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                    {{ session('error') }}!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{ $slot }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
