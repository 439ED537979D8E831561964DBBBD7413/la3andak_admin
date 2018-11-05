</div>
</div>
<?php include APPPATH . '/front-modules/views/footer.php'; //footer file  ?>
<div class="Content-main-new">
    <div class="panel_new">
        <h4>TASKS</h4>
        <ul class="product-list">
            <li>
                <div class="description_block">
                    <input type="checkbox"/>
                    <span class="date_display">15/02/2015</span> <span class="time_display">22:12</span>
                    <p>Lorem ipsum amet</p>
                </div>
                <div class="activity_block">
                    <p>Lorem</p>
                </div>
                <div class="activity_block"> <span>Lorem</span> </div>
            </li>
            <li>
                <div class="description_block">
                    <input type="checkbox"/>
                    <span class="date_display">15/02/2015</span> <span class="time_display">22:12</span>
                    <p>Lorem ipsum amet</p>
                </div>
                <div class="activity_block">
                    <p>Lorem</p>
                </div>
                <div class="activity_block"> <span>Lorem</span> </div>
            </li>
            <li>
                <div class="description_block">
                    <input type="checkbox"/>
                    <span class="date_display">15/02/2015</span> <span class="time_display">22:12</span>
                    <p>Lorem ipsum amet</p>
                </div>
                <div class="activity_block">
                    <p>Lorem</p>
                </div>
                <div class="activity_block"> <span>Lorem</span> </div>
            </li>
            <li>
                <div class="description_block">
                    <input type="checkbox"/>
                    <span class="date_display">15/02/2015</span> <span class="time_display">22:12</span>
                    <p>Lorem ipsum amet</p>
                </div>
                <div class="activity_block">
                    <p>Lorem</p>
                </div>
                <div class="activity_block"> <span>Lorem</span> </div>
            </li>
            <li>
                <div class="description_block">
                    <input type="checkbox"/>
                    <span class="date_display">15/02/2015</span> <span class="time_display">22:12</span>
                    <p>Lorem ipsum amet</p>
                </div>
                <div class="activity_block">
                    <p>Lorem</p>
                </div>
                <div class="activity_block"> <span>Lorem</span> </div>
            </li>
        </ul>
    </div>
    <div class="panel-tab_new" data-toggle="tooltip" data-placement="left" title="Task Deitals"> <i class="fa fa-clock-o fa-2x"></i> </div>
</div>
<a id="viewformlink" href="#viewform" data-toggle="modal" class="btn btn-primary" style="display: none"><i class="fa fa-fw fa-plus"></i></a>
<div class="modal fade" id="viewform">
    <div class="modal-dialog" style="height: auto;width: 75%;">
        <div class="modal-content" >
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" id="formClose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" ><span id="viewformtitle"></span></h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <div id="viewformiframe" style="width: 100%;"></div>
                </div>
            </div>

            <!-- // Modal body END -->
        </div> 
    </div>
</div>

<!-- popup js --> 
<script src="<?php echo $this->config->item('js_url'); ?>popup.js" type="text/javascript" ></script> 
<script>
    $(document).on('open', '.remodal', function () {
        console.log('open');
    });

    $(document).on('opened', '.remodal', function () {
        console.log('opened');
    });

    $(document).on('close', '.remodal', function () {
        console.log('close');
    });

    $(document).on('closed', '.remodal', function () {
        console.log('closed');
    });

    $(document).on('confirm', '.remodal', function () {
        console.log('confirm');
    });

    $(document).on('cancel', '.remodal', function () {
        console.log('cancel');
    });

    // You can open or close it like this:
    // var inst = $.remodal.lookup[$('[data-remodal-id=modal]').data('remodal')];
    // inst.open();
    // inst.close();

    // Or init in this way:
    var inst = $('[data-remodal-id=modal2]').remodal();
    // inst.open();
</script> 

<!-- Calculator Js --> 
<script>
// Get all the keys from document
    var keys = document.querySelectorAll('#calculator span');
    var operators = ['+', '-', 'x', '÷'];
    var decimalAdded = false;

// Add onclick event to all the keys and perform operations
    for (var i = 0; i < keys.length; i++) {
        keys[i].onclick = function (e) {
            // Get the input and button values
            var input = document.querySelector('.screen');
            var inputVal = input.innerHTML;
            var btnVal = this.innerHTML;

            // Now, just append the key values (btnValue) to the input string and finally use javascript's eval function to get the result
            // If clear key is pressed, erase everything
            if (btnVal == 'C') {
                input.innerHTML = '';
                decimalAdded = false;
            }

            // If eval key is pressed, calculate and display the result
            else if (btnVal == '=') {
                var equation = inputVal;
                var lastChar = equation[equation.length - 1];

                // Replace all instances of x and ÷ with * and / respectively. This can be done easily using regex and the 'g' tag which will replace all instances of the matched character/substring
                equation = equation.replace(/x/g, '*').replace(/÷/g, '/');

                // Final thing left to do is checking the last character of the equation. If it's an operator or a decimal, remove it
                if (operators.indexOf(lastChar) > -1 || lastChar == '.')
                    equation = equation.replace(/.$/, '');

                if (equation)
                    input.innerHTML = eval(equation);

                decimalAdded = false;
            }

            // Basic functionality of the calculator is complete. But there are some problems like 
            // 1. No two operators should be added consecutively.
            // 2. The equation shouldn't start from an operator except minus
            // 3. not more than 1 decimal should be there in a number

            // We'll fix these issues using some simple checks

            // indexOf works only in IE9+
            else if (operators.indexOf(btnVal) > -1) {
                // Operator is clicked
                // Get the last character from the equation
                var lastChar = inputVal[inputVal.length - 1];

                // Only add operator if input is not empty and there is no operator at the last
                if (inputVal != '' && operators.indexOf(lastChar) == -1)
                    input.innerHTML += btnVal;

                // Allow minus if the string is empty
                else if (inputVal == '' && btnVal == '-')
                    input.innerHTML += btnVal;

                // Replace the last operator (if exists) with the newly pressed operator
                if (operators.indexOf(lastChar) > -1 && inputVal.length > 1) {
                    // Here, '.' matches any character while $ denotes the end of string, so anything (will be an operator in this case) at the end of string will get replaced by new operator
                    input.innerHTML = inputVal.replace(/.$/, btnVal);
                }

                decimalAdded = false;
            }

            // Now only the decimal problem is left. We can solve it easily using a flag 'decimalAdded' which we'll set once the decimal is added and prevent more decimals to be added once it's set. It will be reset when an operator, eval or clear key is pressed.
            else if (btnVal == '.') {
                if (!decimalAdded) {
                    input.innerHTML += btnVal;
                    decimalAdded = true;
                }
            }

            // if any other key is pressed, just append it
            else {
                input.innerHTML += btnVal;
            }

            // prevent page jumps
            e.preventDefault();
        }
    }
</script> 
<script src="<?php echo $this->config->item('js_url'); ?>tabs.js"></script> 
<!--<script src="<?php echo $this->config->item('js_url'); ?>editor.js"></script> -->
<script src="<?php echo $this->config->item('js_url'); ?>common.js"></script>
</body>
</html>
