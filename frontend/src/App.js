import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
import "./App.scss";
import "swiper/swiper-bundle.min.css";
import "./modal.min.css";
import { Swiper, SwiperSlide } from "swiper/react";
import SingleMember from "./SingleMember";
import { useState, useEffect } from "react";
import SwiperCore, { Autoplay } from "swiper";
import { Button, Modal, ModalFooter, ModalHeader, ModalBody } from "reactstrap";
import { shuffleArray } from "./utils/Functions";

SwiperCore.use([Autoplay]);

const API = process.env.REACT_APP_API || window.location.origin;
function App() {
  const [Members, setMembers] = useState([]);
  const [modal, setModal] = useState(false);
  const [currentMember, setcurrentMember] = useState({});
  const toggle = () => setModal(!modal);

  useEffect(() => {
    fetch(`${API}/wp-json/wp/v2/team_member`)
      .then((res) => res.json())
      .then((result) => {
        setMembers(() => {
          const resMembers = result.map((resultMember) => {
            return {
              name: resultMember.title.rendered,
              description: resultMember.content.rendered,
              image: resultMember.image,
              designation: resultMember.designation,
            };
          });
          return shuffleArray(resMembers);
        });
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
      <Modal isOpen={modal} toggle={toggle} className="member_modal">
        <ModalBody>
          <div
            className="dialog-close-button dialog-lightbox-close-button"
            onClick={toggle}>
            <i className="eicon-close" />
          </div>

          <div className="row">
            <div className="col-lg-4 col-md-12 col-sm-12">
              <div className="col-md-12 profile_image_container">
                <img
                  src={currentMember.image}
                  alt={currentMember.name}
                  className="img-fluid rounded-circle profile_image"
                />
              </div>
              <div className="col-md-12 text-center">
                <div className="pt-2">
                  <h5 className="mt-4 font-weight-medium mb-0 text-white">
                    {currentMember.name}
                  </h5>
                  <h6 className="subtitle mb-3">{currentMember.designation}</h6>
                </div>
              </div>
            </div>
            <div className="col-lg-8 col-md-12 col-sm-12">
              <p
                dangerouslySetInnerHTML={{
                  __html: currentMember.description,
                }}
                className="member_description"></p>
            </div>
          </div>
        </ModalBody>
      </Modal>

      <div className="w-100">
        {Members.length > 0 ? (
          <Swiper {...SliderSettings}>
            {Members.map((member) => {
              return (
                <SwiperSlide className="col-lg-3 mb-4">
                  <SingleMember
                    key={member.id}
                    member={member}
                    setcurrentMember={setcurrentMember}
                    toggle={toggle}
                  />
                </SwiperSlide>
              );
            })}
          </Swiper>
        ) : (
          <div className="text-center p-5">
            <div class="spinner-grow text-warning" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}

export default App;
