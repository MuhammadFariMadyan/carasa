          <div class="x_content">
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>Nama </th>
                                                <th>User Name </th>
                                                <th>Email </th>
                                                <th class=" no-link last"><span class="nobr"></span>
                                                </th>
                                                <th class=" no-link last"><span class="nobr"></span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($admins as $admin)
                                            <tr class="even pointer">
                                                <td>{{$admin->nama}}</td>
                                                <td>{{$admin->username}}</td>
                                                <td>{{$admin->email}}</i>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/editadmin/'.$admin->username)}}">Edit</a>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/deleteadmin/'.$admin->username)}}">Delete</a>
                                                </td>
                                            </tr>
                            
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>