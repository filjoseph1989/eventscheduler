@extends('layouts.master')

@section('page-title', 'List of Organizations')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> LIST OF ORGANIZATIONS </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Leader</th>
                                        <th>Office</th>
                                        <th>Start date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>2011/04/25</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>2011/07/25</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>2009/01/12</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>2012/03/29</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>2008/11/28</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Brielle Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>2012/12/02</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Herrod Chandler</td>
                                        <td>Sales Assistant</td>
                                        <td>San Francisco</td>
                                        <td>2012/08/06</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rhona Davidson</td>
                                        <td>Integration Specialist</td>
                                        <td>Tokyo</td>
                                        <td>2010/10/14</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Colleen Hurst</td>
                                        <td>Javascript Developer</td>
                                        <td>San Francisco</td>
                                        <td>2009/09/15</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sonya Frost</td>
                                        <td>Software Engineer</td>
                                        <td>Edinburgh</td>
                                        <td>2008/12/13</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jena Gaines</td>
                                        <td>Office Manager</td>
                                        <td>London</td>
                                        <td>2008/12/19</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quinn Flynn</td>
                                        <td>Support Lead</td>
                                        <td>Edinburgh</td>
                                        <td>2013/03/03</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Charde Marshall</td>
                                        <td>Regional Director</td>
                                        <td>San Francisco</td>
                                        <td>2008/10/16</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Haley Kennedy</td>
                                        <td>Senior Marketing Designer</td>
                                        <td>London</td>
                                        <td>2012/12/18</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tatyana Fitzpatrick</td>
                                        <td>Regional Director</td>
                                        <td>London</td>
                                        <td>2010/03/17</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Michael Silva</td>
                                        <td>Marketing Designer</td>
                                        <td>London</td>
                                        <td>2012/11/27</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Paul Byrd</td>
                                        <td>Chief Financial Officer (CFO)</td>
                                        <td>New York</td>
                                        <td>2010/06/09</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gloria Little</td>
                                        <td>Systems Administrator</td>
                                        <td>New York</td>
                                        <td>2009/04/10</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bradley Greer</td>
                                        <td>Software Engineer</td>
                                        <td>London</td>
                                        <td>2012/10/13</td>
                                        <td>
                                            <a href="#" class="organization-delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <a href="#">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                        <tr>
                                            <td>Dai Rios</td>
                                            <td>Personnel Lead</td>
                                            <td>Edinburgh</td>
                                            <td>2012/09/26</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jenette Caldwell</td>
                                            <td>Development Lead</td>
                                            <td>New York</td>
                                            <td>2011/09/03</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Yuri Berry</td>
                                            <td>Chief Marketing Officer (CMO)</td>
                                            <td>New York</td>
                                            <td>2009/06/25</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Caesar Vance</td>
                                            <td>Pre-Sales Support</td>
                                            <td>New York</td>
                                            <td>2011/12/12</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Doris Wilder</td>
                                            <td>Sales Assistant</td>
                                            <td>Sidney</td>
                                            <td>2010/09/20</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Angelica Ramos</td>
                                            <td>Chief Executive Officer (CEO)</td>
                                            <td>London</td>
                                            <td>2009/10/09</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gavin Joyce</td>
                                            <td>Developer</td>
                                            <td>Edinburgh</td>
                                            <td>2010/12/22</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jennifer Chang</td>
                                            <td>Regional Director</td>
                                            <td>Singapore</td>
                                            <td>2010/11/14</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Brenden Wagner</td>
                                            <td>Software Engineer</td>
                                            <td>San Francisco</td>
                                            <td>2011/06/07</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fiona Green</td>
                                            <td>Chief Operating Officer (COO)</td>
                                            <td>San Francisco</td>
                                            <td>2010/03/11</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shou Itou</td>
                                            <td>Regional Marketing</td>
                                            <td>Tokyo</td>
                                            <td>2011/08/14</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Michelle House</td>
                                            <td>Integration Specialist</td>
                                            <td>Sidney</td>
                                            <td>2011/06/02</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Suki Burks</td>
                                            <td>Developer</td>
                                            <td>London</td>
                                            <td>2009/10/22</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prescott Bartlett</td>
                                            <td>Technical Author</td>
                                            <td>London</td>
                                            <td>2011/05/07</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gavin Cortez</td>
                                            <td>Team Leader</td>
                                            <td>San Francisco</td>
                                            <td>2008/10/26</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Martena Mccray</td>
                                            <td>Post-Sales support</td>
                                            <td>Edinburgh</td>
                                            <td>2011/03/09</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Unity Butler</td>
                                            <td>Marketing Designer</td>
                                            <td>San Francisco</td>
                                            <td>2009/12/09</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Howard Hatfield</td>
                                            <td>Office Manager</td>
                                            <td>San Francisco</td>
                                            <td>2008/12/16</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hope Fuentes</td>
                                            <td>Secretary</td>
                                            <td>San Francisco</td>
                                            <td>2010/02/12</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vivian Harrell</td>
                                            <td>Financial Controller</td>
                                            <td>San Francisco</td>
                                            <td>2009/02/14</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Timothy Mooney</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>2008/12/11</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jackson Bradshaw</td>
                                            <td>Director</td>
                                            <td>New York</td>
                                            <td>2008/09/26</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Olivia Liang</td>
                                            <td>Support Engineer</td>
                                            <td>Singapore</td>
                                            <td>2011/02/03</td>
                                            <td>
                                                <a href="#" class="organization-delete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="#">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Start date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <a href="{{ route('user.organization.register') }}" type="button" class="btn btn-success" name="button">
                                <i class="material-icons">add</i> Add New
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer')
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.flash.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jszip.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.html5.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.print.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
@endsection
