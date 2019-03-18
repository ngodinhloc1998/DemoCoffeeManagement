                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <h3><b>INVOICE</b> <span class="pull-right">#<?php echo $id_invoice ?></span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">Kofi Kai Coffee</b></h3>
                                            <p class="text-muted m-l-5">267 Lê Văn Lương,
                                                <br/> Nhà Bè, Hồ Chí Minh, Việt Nam
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <h3>To,</h3>
                                            <h4 class="font-bold">Customer</h4>
                                            <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> 23rd Jan 2018</p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Product</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Cost</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($products as $product): ?>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><?php echo $product['name']; ?></td>
                                                    <td class="text-right"><?php echo $product['quantities'] ?></td>
                                                    <td class="text-right"> <?php echo number_format($product['price']); ?> VND</td>
                                                    <td class="text-right"> <?php echo number_format($product['total']); ?> VND</td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>Sub - Total amount: <?php echo number_format($invoice->total);?> VND</p>
                                        <p>vat (10%) : <?php echo number_format($invoice->total*0.1);?> VND</p>
                                        <hr>
                                        <h3><b>Total :</b> <?php echo number_format($invoice->total + $invoice->total*0.1); ?> VND</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-left">
                                        <div class="form-group">
                                            <label for="id-customer">
                                                ID Customer
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">#</span>
                                                    <input type="text" class="form-control-sm" name="id-customer" id="id-customer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>