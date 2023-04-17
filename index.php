<?php 

if(empty($_SESSION['ID'])){
	header('Location: login.php');
}else{
	header('Location: dashboard.php');
}

?>
<?php 
   if(empty($_SESSION['ID'])){
   	header('Location: login.php');
   }else{
   	header('Location: dashboard.php');
   }
   
   ?>
<div class="col-sm-12">
   <table id="example" class="display expandable-table dataTable no-footer" style="width: 100%;" role="grid">
      <thead>
         <tr role="row">
            <th class="select-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="Quote#" style="width: 91px;">Quote#</th>
            <th class="sorting_desc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Product: activate to sort column ascending" style="width: 100px;" aria-sort="descending">Product</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Business type: activate to sort column ascending" style="width: 121px;">Business type</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Policy holder: activate to sort column ascending" style="width: 114px;">Policy holder</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Premium: activate to sort column ascending" style="width: 82px;">Premium</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 81px;">Status</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Updated at: activate to sort column ascending" style="width: 100px;">Updated at</th>
            <th class="details-control sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 32px;"></th>
         </tr>
      </thead>
      <tbody>
         <tr class="odd">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Active</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="even">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Expired</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="odd shown">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>In progress</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr>
            <td colspan="8">
               <table cellpadding="5" cellspacing="0" border="0" style="width:100%;">
                  <tbody>
                     <tr class="expanded-row">
                        <td colspan="8" class="row-bg">
                           <div>
                              <div class="d-flex justify-content-between">
                                 <div class="cell-hilighted">
                                    <div class="d-flex mb-2">
                                       <div class="mr-2 min-width-cell">
                                          <p>Policy start date</p>
                                          <h6>25/04/2020</h6>
                                       </div>
                                       <div class="min-width-cell">
                                          <p>Policy end date</p>
                                          <h6>24/04/2021</h6>
                                       </div>
                                    </div>
                                    <div class="d-flex">
                                       <div class="mr-2 min-width-cell">
                                          <p>Sum insured</p>
                                          <h5>$26,000</h5>
                                       </div>
                                       <div class="min-width-cell">
                                          <p>Premium</p>
                                          <h5>$1200</h5>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-4">
                                       <p>Quote no.</p>
                                       <h6>Incs234</h6>
                                    </div>
                                    <div class="mr-2">
                                       <p>Vehicle Reg. No.</p>
                                       <h6>KL-65-A-7004</h6>
                                    </div>
                                 </div>
                                 <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-4">
                                       <p>Policy number</p>
                                       <h6>Incsq123456</h6>
                                    </div>
                                    <div class="mr-2">
                                       <p>Policy number</p>
                                       <h6>Incsq123456</h6>
                                    </div>
                                 </div>
                                 <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-3 d-flex">
                                       <div class="highlighted-alpha"> A</div>
                                       <div>
                                          <p>Agent / Broker</p>
                                          <h6>Abcd Enterprices</h6>
                                       </div>
                                    </div>
                                    <div class="mr-2 d-flex">
                                       <img src="../../images/faces/face5.jpg" alt="profile">
                                       <div>
                                          <p>Policy holder Name &amp; ID Number</p>
                                          <h6>Phillip Harris / 1234567</h6>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-4">
                                       <p>Branch</p>
                                       <h6>Koramangala, Bangalore</h6>
                                    </div>
                                 </div>
                                 <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-4">
                                       <p>Channel</p>
                                       <h6>Online</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
         <tr class="even">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Active</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="odd">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Active</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="even">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Active</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="odd">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Expired</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="even">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>Active</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="odd">
            <td class=" select-checkbox">Incs235</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 2</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>In progress</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
         <tr class="even">
            <td class=" select-checkbox">Incs234</td>
            <td class="sorting_1">Car insurance</td>
            <td class="">Business type 1</td>
            <td>Jesse Thomas</td>
            <td>$1200</td>
            <td>In progress</td>
            <td>25/04/2020</td>
            <td class=" details-control"></td>
         </tr>
      </tbody>
   </table>
</div>