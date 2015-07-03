<!--- javascript start --->
    
    @components/staff/includes/js/admin-staff-list-ng.js

<!--- javascript end --->


<div class="c-widget c-widget-blank">
    <div class="profile-info" ng-controller="CredentialsController">
        {{ authorization.username }}
        <h3>Credentials</h3>
        <div class="profile-info-block">
            <div class="profile-info-title h6">
                <span class="glyphicon glyphicon-briefcase"></span>
                Username
            </div>
            <div class="profile-info-body">
               <?php echo $aform['username']; ?>
            </div>
        </div>
        <div class="profile-info-block">
            <div class="profile-info-title h6">
                <span class="glyphicon glyphicon-user"></span>
                Password
            </div>
            <div class="profile-info-body">
               <?php echo $aform['password']; ?>
            </div>
        </div>
        <div class="profile-info-block">
            <div class="profile-info-title h6">
                <span class="glyphicon glyphicon-user"></span>
                Confirm Password
            </div>
            <div class="profile-info-body">
               <?php echo $aform['passwordConfirm']; ?>
            </div>
        </div>
        <div class="profile-info-title">
        <?php echo $aform["submit"];?>
        </div>
    </div>
</div>