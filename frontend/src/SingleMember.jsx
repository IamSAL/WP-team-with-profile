import React from "react";

const SingleMember = ({ member, toggle, setcurrentMember }) => {
  return (
    <>
      <div className="col-md-12 profile_image_container">
        <img
          src={member.image}
          alt={member.name}
          className="img-fluid rounded-circle profile_image"
          onClick={() => {
            setcurrentMember(member);
            toggle();
          }}
        />
      </div>
      <div className="col-md-12 text-center">
        <div className="pt-2">
          <h5 className="mt-4 font-weight-medium mb-0">{member.name}</h5>
          <h6 className="subtitle mb-3">{member.designation}</h6>
        </div>
      </div>
    </>
  );
};

export default SingleMember;
