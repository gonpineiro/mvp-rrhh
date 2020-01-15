@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mt-2">
    <div class="col cl-6">
       <button type="button"style="width: 100%;" class="btn btn-primary btn-lg">Botón grande</button>
    </div>
    <script >
            $(document).ready(function() {
            $('#host-table').DataTable({
              "order": [[ 0, "desc" ]]
            });
              } );
    </script>
  </div>
</div>
@endsection
