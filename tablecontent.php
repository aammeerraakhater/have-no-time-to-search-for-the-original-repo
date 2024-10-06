<thead>
                          <tr>
                            <th scope="col">أمر العمل</th>
                            <th scope="col">حالة الخدمة</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">الفني</th>
                            <th scope="col">نوع الخدمه</th>
                            <th scope="col">الموبايل</th>
                            <th scope="col">المدينه</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">الكميه</th>
                            <th scope="col">السعر </th>
                            <th scope="col">المدفوع </th>
                            <th scope="col">الباقي </th>
                            <th scope="col">المندوب</th>
                            <th scope="col">تاريخ الطلب</th>
                            <th scope="col">تاريخ التنفيذ</th>
                            <th scope="col">الملاحظات </th> <!-- 16 -->
                            <th scope="col">Happy call </th> <!-- 17 -->
                            <th scope="col">كتب امر العمل</th> <!-- 17 -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $i = 1;
                          foreach ($results as $result) {
                            $customers = getBased("customer", "customerID", $result['customerID'], 'customerID');
                            foreach ($customers as $customer) {

                          ?>
                              <tr>
                              <td>
                                  <div style="padding:5px;max-width:250px;overflow: auto;">
                                    <a href="./showWorkReq.php?customerID=<?php echo $customer['customerID']; ?>&id=<?php echo $result['id']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $result['workReqNo']; ?></a>
                                  </div>
                                </td>
                                <td>
                                  <select style="width:115px;" class="form-select" id="serviceStatus<?php echo $i; ?>" name="serviceStatus" onchange="changeStatus(serviceStatus<?php echo $i; ?>, <?php echo $result['id']; ?>,this.value)">
                                    <option selected value="" disabled>اختر...</option>
                                    <?php foreach ($serviceStatuses as $serviceStatus) { ?>
                                      <option <?php if ($result['serviceStatus'] == $serviceStatus) {
                                                echo 'selected';
                                              } ?> value="<?php echo $serviceStatus; ?>"> <?php echo $serviceStatus; ?> </option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td>
                                  <div style="padding:5px;max-width:250px;overflow: auto;">
                                    <a href="./showUsr.php?customerID=<?php echo $customer['customerID']; ?>" aria-disabled="true" class="text-decoration-none"> <?php echo $customer['usrName']; ?></a>
                                  </div>
                                </td>
                                <td> <select style="width:150px;height:fit-content;" class="form-select" id="technician<?php echo $i; ?>" name="technician" onchange="changetechnician(technician<?php echo $i; ?>,<?php echo $result['id']; ?>,this.value)">
                                    <option selected value="" disabled>اختر...</option>
                                    <?php foreach ($technicians as $technician) { ?>
                                      <option <?php if ($result['technician'] == $technician['wName']) {
                                                echo 'selected';
                                              } ?> value="<?php echo $technician['wName']; ?>"> <?php echo $technician['wName']; ?> </option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td> <?php echo $result['servicesType']; ?></td>
                                <td> <?php echo $customer['phone']; ?></td>
                                <td> <?php echo $result['city']; ?></td>
                                <td>
                                  <div style="padding:5px;max-width:450px;overflow: auto;">
                                    <?php echo $result['address']; ?>
                                  </div>
                                </td>
                                <td> <?php echo $result['Quantity']; ?></td>
                                <td> <?php echo $result['price']; ?></td>
                                <td> <?php echo $result['paid']; ?></td>
                                <td> <?php echo $result['price'] - $result['paid']; ?></td>
                                <td> <?php echo $result['delegate']; ?></td>
                                <td>
                                  <div style="width:100px;"> <?php echo $result['reqDate']; ?> </div>
                                </td>
                                <td>
                                  <div style="width:100px;"> <?php echo $result['operatedDate']; ?> </div>
                                <td>
                                  <div style="padding:5px;max-width:450px;overflow: auto;"><?php echo $result['Notes']; ?></div>
                                </td>
                                <td>
                                  <div style="padding:5px;max-width:450px;overflow: auto;"><?php echo $result['happyCall']; ?></div>
                                </td>
                                <td> <?php echo $result['editedBy']; ?></td>

                              </tr>
                          <?php
                              $i++;
                            }
                          } ?>
                        </tbody>

                    