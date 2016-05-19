          <div class="x_content">
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>Id</th>
                                                <th>Nama </th>
                                                <th class=" no-link last"><span class="nobr"></span>
                                                </th>
                                                <th class=" no-link last"><span class="nobr"></span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($kategories as $kategori)
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="tableflat">
                                                </td>
                                                <td>{{$kategori->id_kategori}}</td>
                                                <td>{{$kategori->nama}}</td></i>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/editkategori/'.$kategori->id_kategori)}}">Edit</a>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/deletekategori/'.$kategori->id_kategori)}}">Delete</a>
                                                </td>
                                            </tr>
                            
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>