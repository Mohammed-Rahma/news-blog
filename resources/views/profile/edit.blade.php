<x-shop title="Profile">

    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Update your Profile</h2>
                            <p>There are many variations of passages of Lorem
                                Ipsum available, but the majority have suffered alteration in some form.</p>
                        </div>  
                    </div>
                </div>
                <div class="contact-info">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="contact-form-head">
                                <div class="form-main">
                                    <form class="form" method="post" action="{{route('profile.update')}}">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="first_name" type="text" placeholder="First Name"  value="{{old('firs_name' , $user->profile->first_name)}}" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="last_name" type="text" placeholder="Last Name" value="{{old('last_name' , $user->profile->last_name)}}" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" type="email" value="{{old('email' , $user->email)}}"  placeholder="Your Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="birthday" type="date" placeholder="Birthday"  value="{{old('birthday' , $user->profile->birthday)}}" >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group message">
                                                    <textarea name="message" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn ">Update Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



</x-shop>