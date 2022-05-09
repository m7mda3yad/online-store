<?php

//cruds

return [

    'content' => 'Content',
    'home' => 'Home',
    'site' => 'Site',

    'id' => 'ID',
    'name' => 'Name',
    'photo' => 'Photo',
    'created_at'=>'Created At',
    'action' => 'action',
    'add' => 'add',
    'submit' => 'Submit',
    'choose' => 'Choose',
    'upload' => 'Upload',
    'close' => 'Close',
    'view'=>'View',
    'edit'=>'Edit',
    'suspend'=>'Suspend',
    'unsuspend'=>'Un Suspend',
    'delete'=>'Delete',
    'action' => 'Action',
    'price' => 'Price',
    'all_price' => 'All Price',
    'description' => 'Description',
    'real_price' => 'Real Price',
    'video' => 'Video',
    'file' => 'File',
    'profile' => 'Profile',
    'chat' => 'Chat',
    'message' => 'Message',
    'messages' => 'Messages',
    'rate' => 'Rate',
    'view' => 'View',
    'permission' => 'Permission',
    'permissions' => 'Permissions',
    'notifications' => 'Notifications',
    'notification' => 'Notification',
    ///////////////////////// Students

    'order_assign'=>'Order Assign',
    'order_delivered'=>'Order Delivered',
    'order_cancelled'=>'Order Cancelled',

    'name'=>'name',
    'phone'=>'phone',
    'email'=>'email',
    'pay'=>'Pay',
    'payment'=>'payment',
    'status'=>'Status',
    'password'=>'password',
    'confirm_password'=>'Confirm Password',

    /////// website
    'roles'=>'Roles',
    'role'=>'Role',
    'website'=>'Website',
    'users'=>'Users',
    'user'=>'User',
    'assign_role'=>'Assign Role',
    'assign'=>'Assign',
    'select'=>'Select',
    'contact_us'=>'Contact Us',
    'about_us'=>'About Us',
    'sub_categories'=>'sub Categories',
    'sub_category'=>'sub Category',
    'categories'=>'Categories',
    'category'=>'Category',
    'amount'=>'Amount',
    'product'=>'Product',
    'products'=>'Products',
    'cities'=>'Cities',
    'countries'=>'Countries',
    'deliveries'=>'Deliveries',
    'delivery'=>'Delivery',
    'filters'=>'Filters',
    'filter'=>'Filter',
    'customers'=>'Customers',
    'customer'=>'Customer',
    'sub_filter'=>'Sub Filters',
    'orders'=>'Orders',
    'order'=>'Order',
    'delivery_type'=>'Delivery Type',
    'sub_filters'=>'Sub Filter',
    'paid_type'=>'Paid Type',
    'total'=>'total',
    'delivered'=>'Delivered',
    'cancelled'=>'Cancelled',
    'new_orders'=>'New Orders',
    'delivered_orders'=>'Delivered Orders',
    'assign_orders'=>'Assignd Orders',
    'email' =>'email',
    'name' =>'name',
    'logo' =>'logo',
    'phone1' =>'phone1',
    'phone2' =>'phone2',
    'address' =>'address',
    'youtube' =>'youtube',
    'facebook' =>'facebook',
    'instgram' =>'instgram'
];



// One To One

// user has one profile
// user id
// profile user_id

// in User Model
// function profile() {
//     return $this->hasOne(Profile::Class);
// }

// in Profile Model

// function profile() {
//     return $this->belongsTo(User::Class);
// }




// One-to-Many

// Post has many comments

// in Post Model

// function comments() {
//     return $this->hasMany(Comment::Class);
// }


// in Comment Model

// function post() {
//     return $this->belongsTo(Post::Class);
// }



// php artisan make:entity Delivery --fillable="string:email:nullable,string:password:nullable,string:name:nullable,string:phone:nullable,string:photo:nullable,string:address:nullable,"

/*
php artisan make:entity Subscribe --fillable="email:string:nullable"
php artisan make:entity Site --fillable="string:email:nullable,string:name:nullable,string:phone1:nullable,string:phone2:nullable,text:address:nullable"

*/
