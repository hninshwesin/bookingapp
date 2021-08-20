<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ route('doctor.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Doctor List</p>
    </a>

    <a href="{{ route('patient.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-users"></i>
        <p>Patient List</p>
    </a>

    <a href="{{ route('ambulance.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-ambulance"></i>
        <p>Ambulance List</p>
    </a>

    <a href="{{ route('clinic.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-hospital"></i>
        <p>Clinic List</p>
    </a>

    <a href="{{ route('lab.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-heartbeat"></i>
        <p>Oxygen List</p>
    </a>

    <a href="{{ route('pharmacy.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-plus-square"></i>
        <p>Pharmacy List</p>
    </a>

    <a href="{{ route('specialization.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>Specialization List</p>
    </a>
    <a href="{{ route('doctor_approve') }}" class="nav-link active">
        <i class="nav-icon fas fa-arrow-right"></i>
        <p>Approve Doctor</p>
    </a>
    <a href="{{ route('ambulance') }}" class="nav-link active">
        <i class="nav-icon fas fa-arrow-right"></i>
        <p>Approve Ambulance</p>
    </a>
    <a href="{{ route('clinic') }}" class="nav-link active">
        <i class="nav-icon fas fa-arrow-right"></i>
        <p>Approve Clinic</p>
    </a>
    <a href="{{ route('lab') }}" class="nav-link active">
        <i class="nav-icon fas fa-arrow-right"></i>
        <p>Approve Oxygen</p>
    </a>
    <a href="{{ route('pharmacy') }}" class="nav-link active">
        <i class="nav-icon fas fa-arrow-right"></i>
        <p>Approve Pharmacy</p>
    </a>
    <a href="{{ route('language.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-language"></i>
        <p>Language List</p>
    </a>

    <a href="{{ route('terms_of_reference.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-sticky-note"></i>
        <p>Terms Of Reference</p>
    </a>

    <a href="{{ route('cover_image.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-image"></i>
        <p>App Cover Image</p>
    </a>

    <a href="{{ route('doctor_list') }}" class="nav-link active">
        <i class="nav-icon fas fa-bell"></i>
        <p>Send Doctor Notification</p>
    </a>

    {{-- <a href="{{ route('all_user_noti') }}" class="nav-link active">
    <i class="nav-icon fas fa-bell"></i>
    <p>All User Notification</p>
    </a> --}}
</li>