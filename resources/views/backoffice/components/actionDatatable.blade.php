<div class="dropdown">
    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Action
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if (isset($url_edit))
            <a class="dropdown-item" href="{{$url_edit}}">Edit Data</a>
        @endif
        @if (isset($url_detail))
            <a class="dropdown-item" href="{{$url_detail}}">Detail Data</a>
        @endif
        @if (isset($url_delete))
            <a class="dropdown-item delete-item" data-url="{{$url_delete}}">Delete Data</a>
        @endif
    </div>
  </div>