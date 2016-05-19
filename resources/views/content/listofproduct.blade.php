          <div class="x_content">
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>Id</th>
                                                <th>Nama </th>
												<th>Harga </th>
												<th>Jumlah </th>
                                                <th class=" no-link last"><span class="nobr"></span>
                                                </th>
                                                <th class=" no-link last"><span class="nobr"></span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($products as $product)
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="tableflat">
                                                </td>
                                                <td>{{$product->product_id}}</td>
                                                <td>{{$product->nama}}</td>
												<td>{{$product->harga}}</td>
												<td>{{$product->nama}}</td>
												
												</i>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/editproduct/'.$product->product_id)}}">Edit</a>
                                                </td>
                                                <td class=" last"><a href="{{URL::to('/deleteproduct/'.$product->product_id)}}">Delete</a>
                                                </td>
                                            </tr>
                            
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>