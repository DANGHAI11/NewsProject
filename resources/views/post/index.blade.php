@extends("layout.home")
@section("content")

<main class="active">
    <div class="wrap">
      <div class="container">
        <div class="title-category row">
          <div class="title">List Blog</div>
          <div class="category">
            <select name id>
                <option value>Category</option>
                @if($categories)
                    @foreach ($categories as $cate )
                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                    @endforeach
                @endif
            </select>
            <div class="arrow">
              <img src="{{ Vite::asset("resources/images/arrow-bottom.svg") }}" alt="arrow" />
            </div>
          </div>
        </div>
        <div class="body">
          <div class="row">
            @if($post)
                @foreach ($post as $post)
                    <div class="card">
                        <a href={{ route('detail', ['id' => $post->id]) }}>
                            <div class="card-img">
                            <img src="{{ Vite::asset("public/images/").$post->image }}" alt="card" />
                            </div>
                            <div class="card-content">
                            <div class="card-flex">
                                <div class="card-user">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M11.8445 21.1569C8.15273 21.1569 5 20.5824 5 18.2817C5 15.9809 8.13273 13.3569 11.8445 13.3569C15.5364 13.3569 18.6891 15.9603 18.6891 18.2611C18.6891 20.5609 15.5564 21.1569 11.8445 21.1569Z"
                                    stroke="#858383"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    />
                                    <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M11.8373 11.1737C14.26 11.1737 16.2236 9.21003 16.2236 6.7873C16.2236 4.36457 14.26 2.40002 11.8373 2.40002C9.41455 2.40002 7.44998 4.36457 7.44998 6.7873C7.44182 9.20184 9.39182 11.1655 11.8064 11.1737C11.8173 11.1737 11.8273 11.1737 11.8373 11.1737Z"
                                    stroke="#858383"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    />
                                </svg>
                                {{ $post->user->name }}
                                </div>
                                <div class="card-time">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                    d="M12 22.5C9.9233 22.5 7.89323 21.8842 6.16652 20.7304C4.4398 19.5767 3.09399 17.9368 2.29927 16.0182C1.50455 14.0996 1.29661 11.9884 1.70176 9.95156C2.1069 7.91476 3.10693 6.04383 4.57538 4.57538C6.04383 3.10693 7.91476 2.1069 9.95156 1.70176C11.9884 1.29661 14.0996 1.50455 16.0182 2.29927C17.9368 3.09399 19.5767 4.4398 20.7304 6.16652C21.8842 7.89323 22.5 9.9233 22.5 12C22.5 14.7848 21.3938 17.4555 19.4246 19.4246C17.4555 21.3938 14.7848 22.5 12 22.5ZM12 3C10.22 3 8.47992 3.52785 6.99987 4.51678C5.51983 5.50571 4.36628 6.91132 3.68509 8.55585C3.0039 10.2004 2.82567 12.01 3.17294 13.7558C3.5202 15.5016 4.37737 17.1053 5.63604 18.364C6.89472 19.6226 8.49836 20.4798 10.2442 20.8271C11.99 21.1743 13.7996 20.9961 15.4442 20.3149C17.0887 19.6337 18.4943 18.4802 19.4832 17.0001C20.4722 15.5201 21 13.78 21 12C21 9.61306 20.0518 7.32387 18.364 5.63604C16.6761 3.94822 14.387 3 12 3Z"
                                    fill="#858383"
                                    stroke="#858383"
                                    stroke-width="0.5"
                                    />
                                    <path
                                    d="M15.4425 16.5L11.25 12.3075V5.25H12.75V11.685L16.5 15.4425L15.4425 16.5Z"
                                    fill="#858383"
                                    stroke="#858383"
                                    stroke-width="0.5"
                                    />
                                </svg>
                                @php
                                  $minutes = \Carbon\Carbon::now()->diffInMinutes($post->created_at);
                                  if($minutes > 1440){
                                    $time = floor($minutes / 1440) . " days ago";
                                  }
                                  if($minutes > 60)
                                    $time = floor($minutes / 60) . " hours ago";
                                  else {
                                    $time = $minutes . " minutes ago";
                                  }
                                @endphp
                                {{ $time }}
                                </div>
                            </div>
                            <div class="card-title">
                              {{ $post->title }}
                            </div>
                            <div class="card-text">
                              {{ $post->content }}
                            </div>

                            <button class="card-button">
                                Read more
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="10"
                                viewBox="0 0 20 10"
                                fill="none"
                                >
                                <path
                                    d="M19 5H1M19 5L15 9M19 5L15 1"
                                    stroke="#C40000"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                </svg>
                            </button>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
          </div>
        </div>
        <div class="pagination">
          <ul>
            <li class="first">
              <a href>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="7"
                  height="12"
                  viewBox="0 0 7 12"
                  fill="none"
                >
                  <path
                    d="M0.666661 5.9999C0.66628 5.80519 0.734093 5.6165 0.858327 5.46657L5.02499 0.466571C5.16644 0.29639 5.3697 0.18937 5.59006 0.169054C5.81041 0.148737 6.02981 0.216789 6.19999 0.358238C6.37017 0.499686 6.47719 0.702946 6.49751 0.923301C6.51783 1.14366 6.44978 1.36306 6.30833 1.53324L2.57499 5.9999L6.17499 10.4666C6.24422 10.5518 6.29591 10.6499 6.3271 10.7552C6.35829 10.8605 6.36837 10.9709 6.35676 11.0801C6.34514 11.1892 6.31206 11.2951 6.25941 11.3914C6.20677 11.4878 6.1356 11.5728 6.04999 11.6416C5.96431 11.7179 5.86379 11.7757 5.75473 11.8113C5.64566 11.847 5.53041 11.8598 5.41619 11.8488C5.30197 11.8379 5.19125 11.8034 5.09095 11.7477C4.99065 11.692 4.90295 11.6161 4.83333 11.5249L0.808328 6.5249C0.703731 6.37067 0.653852 6.18582 0.666661 5.9999Z"
                    fill="white"
                  />
                </svg>
              </a>
            </li>
            <li><a href>1</a></li>
            <li><a href>2</a></li>
            <li class="active"><a href>3</a></li>
            <li><a href>4</a></li>
            <li><a href>5</a></li>
            <li><a href>6</a></li>
            <li class="end">
              <a href>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="7"
                  height="12"
                  viewBox="0 0 7 12"
                  fill="none"
                >
                  <path
                    d="M6.33333 6.0001C6.33371 6.19481 6.2659 6.3835 6.14167 6.53343L1.975 11.5334C1.83355 11.7036 1.63029 11.8106 1.40994 11.8309C1.18958 11.8513 0.97018 11.7832 0.8 11.6418C0.629819 11.5003 0.522799 11.2971 0.502483 11.0767C0.482167 10.8563 0.550218 10.6369 0.691667 10.4668L4.425 6.0001L0.825002 1.53343C0.75578 1.44819 0.704087 1.35011 0.672894 1.24483C0.641701 1.13954 0.631623 1.02913 0.643239 0.919944C0.654855 0.810754 0.687935 0.704934 0.74058 0.608571C0.793225 0.512207 0.864396 0.427198 0.950002 0.358428C1.03569 0.282112 1.13621 0.224313 1.24527 0.188652C1.35433 0.152991 1.46958 0.140239 1.5838 0.151192C1.69802 0.162144 1.80875 0.196566 1.90904 0.252302C2.00934 0.308038 2.09705 0.383888 2.16667 0.475096L6.19167 5.4751C6.29626 5.62933 6.34614 5.81418 6.33333 6.0001Z"
                    fill="white"
                  />
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</main>

@endsection
