@section('modals')
  <div id="org-profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        @foreach ($organizations as $key => $value)
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">{{ $value->organization->name }}</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td>{{ $value->organization->name }}</td>
              </tr>
              <tr>
                <td>
                  <p>
                   {{ $value->organization->description }}
                  </p>
                </td>
              </tr>
              <tr>
                <td>Lead by: {{ $value->user->full_name }}</td>
              </tr>
              <tr>
                <td>Aniversary: {{ date('m-d-Y', strtotime($value->organization->anniversary)) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
@endsection
