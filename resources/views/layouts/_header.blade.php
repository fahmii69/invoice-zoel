<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title ?? 'No Title' }}</h1>

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home"></i> {{ empty(Request::segments()) ? '' : 'Dashboard' }}
                        </a>
                    </li>
                    
                    @php 
                        $segment = ''; 
                        $segmentText = '';
                    @endphp
        
                    @for ($i = 1; $i <= count(Request::segments()); $i++)
                        @php 
                            $segment .= '/' . Request::segment($i);
                            $text     = explode('_', Request::segment($i));
                            if (count(Request::segments()) < 3) {
                                if (count($text) > 1) {
                                    for ($key=0; $key < count($text); $key++) { 
                                        $segmentText .= $text[$key].' ';
                                    }
                                } else {
                                    $segmentText = Request::segment($i);
                                }
                            } else {
                                if (count($text) > 1) {
                                    for ($key=0; $key < count($text); $key++) { 
                                        $segmentText .= $text[$key].' ';
                                    }
                                } else  {
                                    $segmentText = Request::segment($i);
                                }
                            }
                        @endphp
        
                        @if (!is_numeric(Request::segment($i)))
                            @if ($i < count(Request::segments()) && (Request::segment($i) != 'edit' && Request::segment($i) != 'show'))
                                <li class="breadcrumb-item">
                                    <a href="{{ url($segment) }}">{{ ucwords($segmentText) }}</a>
                                </li>
                            @else
                                <li class="breadcrumb-item active">
                                    {{ Request::segment($i) == "create" ? 'Add' : ucwords($segmentText) }}
                                </li>
                            @endif
                        @endif
                    @endfor
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


{{-- <div class="content-heading">
    <div class="heading-left">
        <h1 class="page-title">{{ $title ?? 'No Title' }}</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">
                    <i class="fa fa-home"></i> {{ empty(Request::segments()) ? '' : 'Dashboard' }}
                </a>
            </li>
            
            @php 
                $segment = ''; 
                $segmentText = '';
            @endphp

            @for ($i = 1; $i <= count(Request::segments()); $i++)
                @php 
                    $segment .= '/' . Request::segment($i);
                    $text     = explode('_', Request::segment($i));
                    if (count(Request::segments()) < 3) {
                        if (count($text) > 1) {
                            for ($key=0; $key < count($text); $key++) { 
                                $segmentText .= $text[$key].' ';
                            }
                        } else {
                            $segmentText = Request::segment($i);
                        }
                    } else {
                        if (count($text) > 1) {
                            for ($key=0; $key < count($text); $key++) { 
                                $segmentText .= $text[$key].' ';
                            }
                        } else  {
                            $segmentText = Request::segment($i);
                        }
                    }
                @endphp

                @if (!is_numeric(Request::segment($i)))
                    @if ($i < count(Request::segments()) && (Request::segment($i) != 'edit' && Request::segment($i) != 'show'))
                        <li class="breadcrumb-item">
                            <a href="{{ url($segment) }}">{{ ucwords($segmentText) }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item active">
                            {{ Request::segment($i) == "create" ? 'Tambah' : ucwords($segmentText) }}
                        </li>
                    @endif
                @endif
            @endfor
        </ol>
    </nav>
</div> --}}
