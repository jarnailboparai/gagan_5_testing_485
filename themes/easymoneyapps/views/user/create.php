<h1>Join SkyBuilder Today - 30 Day Unconditional Guarantee</h1>

<!-- content starts here -->
<div class="am-signup">
    <!-- login box on signup page widget -->
    <div class="am-login-text">If you already have an account on our website, please <!--<a href="javascript:" id="show-login-box-on-signup">login</a>-->
        <?php echo CHtml::link('login', array('/site/login')); ?>
        to continue</div>

    <!-- login box on signup page widget end -->    

    <div class="am-form">
<!--        <form action="./Join SkyBuilder Today_files/Join SkyBuilder Today.htm" id="page-0" method="post" class="am-signup-form" novalidate="novalidate">-->
        <?php
            $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                    ),
            ));
        ?>
            <div class="row" id="row-product_id-0">
                <div class="element-title">
                    <label for="product_id-0"><span class="required">* </span>Membership Type</label>
                </div>
                <div class="element">
<!--                    <input type="radio" name="product_id" data-first_price="997.00" data-second_price="997.00" checked="checked" value="3-3" id="product_id---0">
                    <label for="product_id---0" class="radio">&nbsp;<b>SkyBuilder One Year License</b> $997.00 for each one year<br><span class="small">A One Year Unlimited License for Access to SkyBuilder - Includes one Ticket to SkyBuilders LIVE!  (Best Value a %56 Savings)</span><br></label><br>
                    <input type="radio" name="product_id" data-first_price="147.00" data-second_price="147.00" value="9-9" id="product_id---1">
                    <label for="product_id---1" class="radio">&nbsp;<b>SkyBuilder Monthly License</b> $147.00 for each one month<br><span class="small">Pay per month - Cancel Anytime</span><br></label><br>-->
                    <?php
                        if ($model->membership_type=='')
                            $model->membership_type='yearly';
                        $rad_arr = array(
                            'yearly'=>'<b>SkyBuilder One Year License</b> $997.00 for each one year<br><span class="small">A One Year Unlimited License for Access to SkyBuilder - Includes one Ticket to SkyBuilders LIVE!  (Best Value a %56 Savings)</span>',
                            'monthly'=>'<b>SkyBuilder Monthly License</b> $147.00 for each one month<br><span class="small">Pay per month - Cancel Anytime</span>'
                        );
                        echo $form->radioButtonList($model, 'membership_type', $rad_arr, array('separator'=>'<br />',
                                'labelOptions'=>array()
                            ));
                    ?>
                    <br>
                </div>
            </div>

            <div class="row" id="row-paysys_id" style="">
                <div class="element-title">
                    <label for="paysys_id"><span class="required">* </span>Payment System</label>
                </div>
                <div class="element">
<!--                    <input type="radio" name="paysys_id" checked="checked" value="twocheckout" id="paysys_id---0">
                    <label for="paysys_id---0" class="radio">&nbsp;<b>2Checkout</b><br><span class="small">Pay with a Credit Card</span></label><br>
                    <input type="radio" name="paysys_id" value="paypal" id="paysys_id---1">
                    <label for="paysys_id---1" class="radio">&nbsp;<b>PayPal</b><br><span class="small">Pay with your PayPal Account</span></label><br>-->
                    <?php
                        if ($model->payment_system=='')
                            $model->payment_system = 'checkout';
                        $rad_arr = array(
                            'checkout'=>'<b>2Checkout</b><br><span class="small">Pay with a Credit Card</span>',
                            'paypal'=>'<b>PayPal</b><br><span class="small">Pay with your PayPal Account</span></label>'
                        );
                        echo $form->radioButtonList($model, 'payment_system', $rad_arr, array('separator'=>'<br />',
                                'labelOptions'=>array()
                            ));
                    ?>
                    <br>
                </div>
            </div>

            <div class="row" id="row-name-0">
                <div class="element-title">
                    <label><span class="required">* </span>First &amp; Last Name</label>
                </div>
                <div class="element group">
<!--                    <input type="text" size="15" name="name_f" id="name_f-0">
                    <input type="text" size="15" name="name_l" id="name_l-0">-->
                    <?php
                        echo $form->textField($model,'first_name', array('id'=>'name_f-0','size'=>'15'));
                        echo $form->textField($model,'last_name', array('id'=>'name_l-0','size'=>'15'));
                    ?>
                </div>
            </div>

            <div class="row" id="row-email-0">
                <div class="element-title">
                    <label for="email-0"><span class="required">* </span>Your E-Mail Address</label>
                    <div class="comment">a confirmation email will be sent<br>
                        to you at this address</div>
                </div>
                <div class="element">
<!--                    <input type="text" size="30" name="email" id="email-0">-->
                        <?php echo $form->textField($model,'email', array('id'=>'email-0','size'=>'30')); ?>
                </div>
            </div>

            <div class="row" id="row-login-0">
                <div class="element-title">
                    <label for="login-0"><span class="required">* </span>Choose a Username</label>
                    <div class="comment">it must be 4 or more characters in length<br>
                        may only contain letters, numbers, and underscores</div>
                </div>
                <div class="element">
<!--                    <input type="text" size="15" maxlength="32" name="login" id="login-0">-->
                        <?php echo $form->textField($model,'username', array('id'=>'name_f-0','size'=>'15','maxlength'=>'32')); ?>
                </div>
            </div>

            <div class="row" id="row-pass-0">
                <div class="element-title">
                    <label for="pass-0"><span class="required">* </span>Choose a Password</label>
                    <div class="comment">must be 6 or more characters</div></div>
                <div class="element">
<!--                    <input type="password" size="15" maxlength="32" name="pass" id="pass-0">-->
                        <?php echo $form->passwordField($model,'password', array('id'=>'name_f-0','size'=>'15', 'maxlength'=>'32')); ?>
                </div>
            </div>

            <div class="row" id="row-_pass-0">
                <div class="element-title">
                    <label for="_pass-0"><span class="required">* </span>Confirm Your Password</label>
                </div>
                <div class="element">
<!--                    <input type="password" size="15" name="_pass" id="_pass-0">-->
                        <?php echo $form->passwordField($model,'repeat_password', array('id'=>'name_f-0','size'=>'15', 'maxlength'=>'32')); ?>
                </div>
            </div>

            <div class="row" id="row-html1-0">
                <div class="element-title">
                    <label for="html1-0"></label>
                </div>
                <div class="element">
                    <input type="hidden" name="ship_name" id="ship_name" value="null">
                    <script id="pap_x2s6df8d" src="./Join SkyBuilder Today_files/salejs.php" type="text/javascript">
                    </script>
                    <div style="position:absolute;bottom:0px;left:0px;"><object width="1px" height="1px"><param name="movie" value="http://skybuilder.net/affiliate/scripts/pap.swf?a=r&amp;n0=PAPVisitorId&amp;n1=PAPCookie_Sale&amp;n2=PAPCookie_FirstClick&amp;n3=PAPCookie_LastClick"><param name="AllowScriptAccess" value="always"><embed src="http://skybuilder.net/affiliate/scripts/pap.swf?a=r&amp;n0=PAPVisitorId&amp;n1=PAPCookie_Sale&amp;n2=PAPCookie_FirstClick&amp;n3=PAPCookie_LastClick" type="application/x-shockwave-flash" width="1px" height="1px" allowscriptaccess="always"></object></div>
                    <script type="text/javascript">
                        PostAffTracker.writeCookieToCustomField('ship_name');
                    </script></div></div>

            <fieldset id="fieldset-agreement"><legend id="fieldset-agreement-legend">&nbsp;&nbsp;User Agreement</legend>
                <div class="row" id="row-_agreement-0"><div class="element-title"><label for="_agreement-0"></label></div><div class="element"><div class="agreement">IMPORTANT TERMS OF USE TO ACCESS THIS WEBSITE AND TO BUY OUR PRODUCTS OR SERVICES

                            You may be referred to as Licensee. The terms 'You' or 'Licensee' includes you and any of your owners, employees, partners, independent contractors, subsidiaries, affiliates, attorneys, agents, heirs, and assigns.

                            We may be referred to as Licensor. The terms 'Us,' 'We,' or 'Licensor' includes Waymaker Labs Limited, Greg Jacobs, Micheal Sabatini, our owners, employees, subsidiaries, independent contractors, agents, attorneys, and assigns.

                            You must be at least 18 years old to access this website or to purchase products or services from us.

                            We do not direct this website to minors, nor do we knowingly collect any personal information from children under the age of thirteen.

                            Our products, services and information are for business purposes and not for personal or household use.

                            Disclaimers

                            We do not promise nor imply any claims of income. You are purchasing TOOLS, Not results with these tools.

                            ALL CONTENT AND SOFTWARE IS PROVIDED "AS IS" AND ANY AND ALL WARRANTIES ARE DISCLAIMED, WHETHER EXPRESS OR IMPLIED, INCLUDING, WITHOUT LIMITATION, ANY IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.

                            Our cumulative liability to you or anyone else for any loss or damages resulting from any claims, demands, or actions arising out of or relating to this Agreement or use of the software, content or website shall not exceed the amount you have paid to us for the product or service. In no event shall we be liable for any indirect, incidental, consequential, special, or exemplary damages or lost profits, even if we have been advised of the possibility of such damages. You agree that the foregoing constitutes your sole and exclusive remedy for any breach of this Agreement.

                            There is no promise or representation that you will make a certain amount of money, or any money, or not lose money, as a result of using our products and services. Any earnings, revenue, or income statements are strictly estimates. There is no guarantee that you will make these levels for yourself. As with any business, your results will vary and will be based on your personal abilities, experience, knowledge, capabilities, level of desire, and an infinite number of variables beyond our control, including variables we or you have not anticipated. There are no guarantees concerning the level of success you may experience. Each person's results will vary.

                            We are not liable for, and you expressly waive, any liability or damages to any computer, server, mobile phone or web host from use of our software.

                            We are not liable for, and you expressly waive, any liability or damages if you have an account terminated, whether it be an affiliate account, hosting, domain registration, or any other legal action against you.

                            Our software is designed to work in a designated "sandbox" environment and we will offer technical support for it to work within those confines. We are not responsible for ensuring compatibility with 3rd plugins, addons or specific versions of mobile phones or Operating Systems. Our software is designed to build Mobile Apps for the most current and popular Android and IOS versions of mobile software and hardware. We cannot guarantee that it will work on any particular version or mobile phone, though we will always make our best efforts to assist.

                            Our software is in part designed to help you earn affiliate commissions with various companies described in pertinent software. It is your sole responsibility to obtain any affiliate accounts and to keep them in good standing. We do not promise that use of our software or services will acceptable by any merchant or affiliate network.

                            There are unknown risks in any business, particularly with the Internet where advances and changes can happen quickly.

                            The use of our information, products and services should be based on your own due diligence and you agree that we are not liable for your success or failure.

                            Prohibited Uses

                            You may NOT use our software, including but not limited SKYBUILDER Tools to violate the Terms of Service of any 3rd party website, software or service. You are responsible for reviewing the Terms of Service of all 3rd Party Website to make sure that you comply.

                            Your license applies to single user only and cannot be transferred in any way. You may sell or lease the Mobile Apps created with SkyBuilder, however at no time may you "lease," "rent" or "share" your license or logins with outside parties. This specifically includes "group buys" and related. We reserve the right to monitor usage and if we see multiple amounts of activity coming from different IP addresses, we reserve the right to investigate and possibly cancel your license.

                            You are solely responsible for complying with all laws wherever you are located, your web sites and apps are hosted, and are accessed.

                            You will not assign, sublicense, transfer, pledge, sell, lease, rent, lend, or otherwise dispose of our content, products and software, or any part of, or share your rights under this Agreement, to others.

                            You will not give others access to your username and password.

                            You will not violate any laws, third party rights, or this Agreement. This includes, but is not limited to, not posting any material or content that is defamatory, harassing, belongs to someone else, is obscene or pornographic

                            You will not use the Software to Create apps that are pornographic, obscene, graphically violent, hate-based, illegal, disseminates information that could be used to commit a crime or those that infringe on the rights of another. IF we find you creating such apps we reserve the right to immediately terminate your account and report you to law enforcement officials if we detect potential illegal activity. This includes creating apps which link to websites or resources as described

                            You will not provide false or misleading information to us.

                            Software Agreement

                            YOU AGREE TO BE BOUND BY THESE TERMS AND ANY EULA IN THE SOFTWARE BY INSTALLING, COPYING, OR OTHERWISE USING ANY SOFTWARE SOLD BY US.

                            IF YOU DO NOT AGREE, DO NOT INSTALL, COPY, OR USE THE SOFTWARE; YOU MAY REQUEST A REFUND WITHIN 30 DAYS AS PROVIDED IN THESE TERMS.

                            The software is for your use only and may not be copied, sold, rented, leased, or transferred to others.

                            The Software is licensed, not sold. The Software is protected by copyright and other intellectual property laws. SkyBuilder, SkyBuilder Cloud, SkyBuilder SMB, Keyword Genesis, WPSky SkyTheme Premium, and related titles are trademarks of Waymaker Labs Limited and Greg Jacobs.

                            The software allows you to automate your use of content originally located or created on other websites. This includes but is not necessarily limited article directories, video depository such as YouTube, image depository such as Flickr, and user created content depository. You, and not us, are solely responsible for reading, understanding, complying, and staying up to date with all rules for use of content originating on those sites. The particular websites are described in the software.

                            Using this software does not imply, guarantee, nor state that any of the apps created with it will be accepted to various mobile "Stores" and platforms including but not exclusively the "AppStore" and "Google Play" You acknowledge that there are many factors that determine whether an app will be accepted or not and will not hold the Licensor responsible in anyway for the non-acceptance of your apps on these platforms. This specifically includes requesting a refund after the 30 day refund period because your app was not accepted, canceled or rejected. SkyBuilder is sold as a toolkit that performs functions, not "results" with these tools. By using SkyBuilder you acknowledge this fact.

                            If you breach this Agreement your license to use our software automatically terminates.

                            The Software may require an active Internet connection and account in good standing to be activated and then accessed and used. You acknowledge and agree that we may automatically check the version of the Software and/or its components that you are utilizing, account information, and may provide upgrades or fixes to the Software that will be downloaded and required for further use of the Software.

                            Consent to Use Information

                            When you communicate with us, send us information, or provide content to us or our website, including but not limited to the members forum, you grant us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sublicensable right to exercise all copyright and publicity rights you have in the content and with use of your name associated with the content, in any manner whatsoever, in any media now known or which may be created in the future, including in other works and forms not associated with this website.

                            No Waiver of Rights

                            Our failure to enforce any rights granted in this Agreement or to take action against any other party in the event of any breach shall not be deemed a waiver by us as to subsequent enforcement of rights or subsequent actions in the event of future breaches.

                            Refund Policy

                            We offer a 30 day refund policy. Just write us and ask within 30 days from purchase and your refund will be issued. We will only refund payments made within the previous 30 days and do not offer pro-rated refunds. If you have purchased a one year license and are past 30 days from initial purchase it will not be refunded nor pro-rated refunded. If you have purchased a monthly license and wish a refund, we will only refund the payment made int he last 30 days. Previous payments are not eligible for refunds.

                            If you request a refund you are acknowledging that yo do not wish to use our software and must delete all Apps created from it from your computer, mobile phone and remove them from the AppStore and Android store in addition to your clients sites and phones. If you request a refund for our services you must destroy all content created with our software.

                            Cancellation Policy

                            You may at any time decide to no longer continue with our service and cancel your ongoing license. IF you cancel your license, you still have rights to all apps created with our software, however you will no longer be able to update these apps from within SkyBuilder, nor access Push Notifications, Ad Interface and other features controlled through the SkyBuilder members area.

                            Miscellaneous

                            This Agreement in all respects shall be governed by and construed according to the laws of the SAR Hong Kong, to the exclusion of any other applicable body of governing law, without regard to conflicts of laws principles.

                            This Agreement is entered into in the SAR Hong Kong. skybuilder.com and related sites are controlled, operated and administered exclusively in Asia. You consent to the exclusive jurisdiction of SAR Hong Kong for any dispute arising from or related to this Agreement or our software.

                            If a dispute arises relating to or arising from this Agreement, use of our websites, or purchase or use of our products or services, we both agree to first try to resolve it with the help of a mutually agreed-upon mediator in the following location: SAR Hong Kong. Any costs and fees other than attorney fees associated with the mediation will be shared equally by each of us.

                            If it proves impossible to arrive at a mutually satisfactory solution through mediation, we both agree to submit the dispute to binding arbitration at the following location: SAR Hong Kong. Judgment upon the award rendered by the arbitration may be entered in any court with jurisdiction to do so. You agree not to contest any judgment in SAR Hong Kong when it is sought to be enforced in any other country.

                            You agree that the exclusive venue for any dispute will be in SAR Hong Kong.

                            You understand and agree that you are giving up your right to a court trial for any dispute.

                            You agree any and all claims will be individually decided and not combined into a class action or other representative or multi-party action, and there is no authority for an arbitrator to decide any claim or enter any judgment except as to both of us individually.

                            Should any term of this Agreement be declared void or unenforceable, that term shall be severed from the Agreement such declaration shall have no effect on the enforceability of the remaining terms.

                            This Agreement contains the complete and entire understanding and agreement between you and us and supersedes any previous communications, representations, or agreements, verbal or written, related to the subject matter of this Agreement.

                            This Agreement may not be modified or amended orally, impliedly, or in any manner not set forth in writing or permitted by this Agreement.

                            This Agreement may be amended by us at any time and without notice, but only by amending this Agreement as posted on this website, unless otherwise agreed to in a writing signed by both of us.

                            Any amendments will become effective 30 days after being posted on the website, unless circumstances require that a change be immediately implemented. As a condition for this Agreement you agree to periodically check this Agreement posted at this page.

                            You agree that your continued access of our website or use of our products or services after that date will constitute your consent and acceptance of the amendment.

                            Date of this Agreement: July 3rd, 2012</div></div></div>

                <div class="row" id="row-i_agree-0">
                    <div class="element-title"><label for="i_agree-0"><span class="required">* </span>I Agree</label></div>
                    <div class="element">
<!--                        <input type="checkbox" name="i_agree" id="i_agree-0" value="1">-->
                        <?php echo $form->checkBox($model, 'iagree', array()); ?>
                        <?php echo $form->error($model, 'iagree'); ?>
                    </div>
                </div>
            </fieldset>

            <div class="row" id="row-qfauto-2"><div class="element-title"><label></label></div><div class="element group">
<!--                    <input type="submit" value="Next" name="_qf_page-0_next" id="_qf_page-0_next-0">-->
                        <?php echo CHtml::submitButton('Register'); ?>
                </div></div>
            <input type="image" id="_qf_default" width="1" height="1" src="./Join SkyBuilder Today_files/empty.gif" name="_qf_page-0_next" style="display: none;"><input type="hidden" name="_save_" id="_save_-0" value="page-0">
            <input type="hidden" name="pap_custom" value="default1null" id="pap_dx8vc2s5">
        <!--</form>-->
        <?php
            $this->endWidget();
        ?>
    </div>

</div>
<!-- This template handles dynamic (AJAX-controlled) list of states
   dependent on countries
   This is used at least on signup/profile/cc entering/admin user form pages
-->
