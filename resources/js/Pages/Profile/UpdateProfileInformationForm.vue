<template>
  <jet-form-section @submitted="updateProfileInformation">
    <template #title> Profile Information </template>

    <template #description>
      Update your account's profile information and email address.
    </template>

    <template #form>
      <!-- Profile Photo -->
      <div
        class="col-span-6 sm:col-span-4"
        v-if="$page.props.jetstream.managesProfilePhotos"
      >
        <!-- Profile Photo File Input -->
        <input
          type="file"
          class="hidden"
          ref="photo"
          @change="updatePhotoPreview"
        />

        <jet-label for="photo" value="Photo" />

        <!-- Current Profile Photo -->
        <div class="mt-2" v-show="!photoPreview">
          <img
            :src="user.profileImgUrl"
            :alt="user.firstName"
            class="rounded-full h-20 w-20 object-cover"
          />
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" v-show="photoPreview">
          <span
            class="block rounded-full w-20 h-20"
            :style="
              'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
              photoPreview +
              '\');'
            "
          >
          </span>
        </div>

        <jet-secondary-button
          class="mt-2 mr-2"
          type="button"
          @click.prevent="selectNewPhoto"
        >
          Select A New Photo
        </jet-secondary-button>

        <jet-secondary-button
          type="button"
          class="mt-2"
          @click.prevent="deletePhoto"
          v-if="user.profile_photo_path"
        >
          Remove Photo
        </jet-secondary-button>

        <jet-input-error :message="form.errors.photo" class="mt-2" />
      </div>

      <!-- Name -->
      <div class="col-span-6 sm:col-span-4">
        <div class="grid grid-cols-2 gap-4">
          <div class="col-span-1">
            <jet-label for="firstName" value="First Name" />
            <jet-input
              id="firstName"
              type="text"
              class="mt-1 block w-full"
              v-model="form.firstName"
              autocomplete="firstName"
            />
            <jet-input-error :message="form.errors.firstName" class="mt-2" />
          </div>
          <div class="col-span-1">
            <jet-label for="lastName" value="Last Name" />
            <jet-input
              id="lastName"
              type="text"
              class="mt-1 block w-full"
              v-model="form.lastName"
              autocomplete="lastName"
            />
            <jet-input-error :message="form.errors.lastName" class="mt-2" />
          </div>
          <div class="col-span-1">
            <jet-label for="nickName" value="Nick Name" />
            <jet-input
              id="nickName"
              type="text"
              class="mt-1 block w-full"
              v-model="form.nickName"
              autocomplete="nickName"
            />
            <jet-input-error :message="form.errors.nickName" class="mt-2" />
          </div>
          <div class="col-span-1">
            <jet-label for="birthday" value="Birthday" />
            <jet-input
              id="birthday"
              type="date"
              class="mt-1 block w-full"
              v-model="form.birthday"
              autocomplete="birthday"
            />
            <jet-input-error :message="form.errors.birthday" class="mt-2" />
          </div>
          <div class="col-span-2">
            <jet-label for="address" value="Address" />
            <jet-text-area
              id="address"
              type="date"
              class="mt-1 block w-full"
              v-model="form.address"
              autocomplete="address"
            />
            <jet-input-error :message="form.errors.address" class="mt-2" />
          </div>
          <div class="col-span-1">
            <jet-label for="phoneNumber" value="Phone Number" />
            <jet-input
              id="phoneNumber"
              type="text"
              class="mt-1 block w-full"
              v-model="form.phoneNumber"
              autocomplete="phoneNumber"
            />
            <jet-input-error :message="form.errors.phoneNumber" class="mt-2" />
          </div>
          <div class="col-span-1">
            <jet-label for="facebook" value="Facebook" />
            <jet-input
              id="facebook"
              type="text"
              class="mt-1 block w-full"
              v-model="form.facebook"
              autocomplete="facebook"
            />
            <jet-input-error :message="form.errors.facebook" class="mt-2" />
          </div>
        </div>
      </div>

      <!-- Email -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
        />
        <jet-input-error :message="form.errors.email" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </jet-action-message>

      <jet-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetTextArea from "@/Jetstream/TextArea";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetTextArea,
  },

  props: ["user"],

  data() {
    return {
      form: this.$inertia.form({
        _method: "PUT",
        ...this.user,
        photo: null,
      }),

      photoPreview: null,
    };
  },

  methods: {
    updateProfileInformation() {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0];
      }

      this.form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
      });
    },

    selectNewPhoto() {
      this.$refs.photo.click();
    },

    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);
    },

    deletePhoto() {
      this.$inertia.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => (this.photoPreview = null),
      });
    },
  },

  mountd() {
    console.log(this.user);
  },
};
</script>
