@extends('layouts.main')

@section('content')
<section class="equipments section-spacing text-center" id="equipments">
  <div class="container">
    <header class="section-header">
      <h2>DASHBOARD</h2>
    </header>
    <div class="row">
      <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none rwd-table" id="tbl-equipments">
              <thead>
                <tr>
                  <th></th>
                  <th>Status</th>
                  <th>Date Ordered</th>
                  <th>Expect Arrival</th>
                  <th>Received Date</th>
                  <th>Tracking Code</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @forelse($equipments as $key => $value)
                    <tr>
                      <td>{{$key}}</td>
                      <td>{{$value->status}}</td>
                      <td>{{isset($value->date_ordered) ? date('jS F Y', strtotime($value->date_ordered)) : ''}}</td>
                      <td>{{isset($value->expected_arrival) ? date('jS F Y', strtotime($value->expected_arrival)) : ''}}</td>
                       <td>{{isset($value->received_date) ? date('jS F Y', strtotime($value->received_date)) : ''}}</td>
                       <td>{{$value->tracking_code}}</td>
                       <td>
                        <button <?php if(strtolower($value->status) =='received') echo 'disabled';?> class="btn btn-default action-delivered" data-id="{{$value->equipment}}">Delivered</button>
                       </td>
                    </tr>
                  @empty
                    <h3>No data found.</h3>
                  @endforelse
              </tbody>
            </table>
          </div>
      </div>
    </div>
</section>
@endsection

@push('scripts')
{!!Html::script('js/pages/equipments.js')!!}
@endpush