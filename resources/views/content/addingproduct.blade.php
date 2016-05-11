  <div class="x_content">
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{URL::to('/registerproduct/')}}" method = "POST">
                                            {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="nama" name = "nama" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori"> Kategori <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="kategori" name="kategori" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Stock</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="stock" class="form-control col-md-7 col-xs-12" type="text" name="stock">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Harga <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type = "text" id="foto" name = "harga" class="date-picker form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Gambar <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type = "text" id="foto" name = "foto" class="date-picker form-control col-md-7 col-xs-12" required="required">
                                            </div>
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