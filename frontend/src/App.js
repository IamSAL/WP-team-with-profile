import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
//import "bootstrap/dist/css/bootstrap.min.css";
import "./App.css";
import "swiper/swiper-bundle.min.css";
import { Swiper, SwiperSlide } from "swiper/react";
import SingleMember from "./SingleMember";
import { useState, useEffect } from "react";
import SwiperCore, { Autoplay } from "swiper";
SwiperCore.use([Autoplay]);

const API = process.env.REACT_APP_API || window.location.origin;
function App() {
  const [Members, setMembers] = useState([]);

  useEffect(() => {
    fetch(`${API}/wp-json/wp/v2/team_member`)
      .then((res) => res.json())
      .then((result) => {
        setMembers(
          result.map((resultMember) => {
            return {
              name: resultMember.title.rendered,
              description: resultMember.content.rendered,
              image: resultMember.image,
              designation: resultMember.designation,
            };
          })
        );
      });
    return () => {};
  }, []);
  const [SliderSettings, setSliderSettings] = useState({
    slidesPerView: 4,
    speed: 1300,
    parallax: true,
    freeMode: true,
    autoplay: {
      delay: 2000,
    },
    loop: true,
    breakpoints: {
      1024: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 2,
      },
      640: {
        slidesPerView: 1,
      },
      320: {
        slidesPerView: 1,
      },
    },
  });

  return (
    <div className="py-5 team4">
      <div className="container">
        {Members.length > 0 && (
          <Swiper {...SliderSettings}>
            {Members.map((member) => {
              return (
                <SwiperSlide className="col-lg-3 mb-4">
                  <SingleMember key={member.id} member={member} />
                </SwiperSlide>
              );
            })}
          </Swiper>
        )}
      </div>
    </div>
  );
}

export default App;
