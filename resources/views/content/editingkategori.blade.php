  <div class="x_content">
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{URL::to('/savekategori/')}}" method = "POST">
                                  {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="nama" name = "nama" required="required" class="form-control col-md-7 col-xs-12" value="{{$result['nama']}}">
                                            </div>
                                            <input name="olduname" type="hidden" value="{{$result['nama']}}">
											<input name="oldid" type="hidden" value="{{$result['id_kategori']}}">
                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                <button type="reset" class="btn btn-primary">Cancel</button>
                                                
                                            </div>
                                        </div>

                                    </form>
                                </div>