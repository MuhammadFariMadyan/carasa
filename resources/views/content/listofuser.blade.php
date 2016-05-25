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
                                            @foreach($users as $user)
                                            <tr class="even pointer">
                                                <td>{{$user->nama}}</td>
                                                <td>{{$user->username}}</td>
                                                <td>{{$user->email}}</i>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/edituser/'.$user->username)}}">Edit</a>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/deleteuser/'.$user->username)}}">Delete</a>
                                                </td>
                                            </tr>
                            
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>