<div class="row">

  <div class="col-md-6 col-md-offset-3">

    <h1 style="color: purple;"><center><b>Process Data</b></center></h1>
    <hr>
    @if(isset($items))
      <div class="tab-content">
          <div role="tabpanel" class="tab-pane tab-margin table-area-margin active" id="profile">
            <div class="table-responsive">
              <table class="table payment-info-tbl">
                <tr class="displaying-passages-title">
                  <th>Your Field</th>
                </tr>
                @foreach ($items as $datas)
                  <tr>
                  
                    <td><input type="text" name="start" class="form-control" value = {{$datas->ncr_id}} required ></td>
                  </tr>
                @endforeach

              </table>
            </div>
          </div><!--tab panel profile-->
      </div><!--tab content-->
    @else
      <h1>No Data</h1>
    @endif



  </div>

</div>